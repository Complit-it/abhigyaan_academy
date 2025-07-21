<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Gallery;
use App\Models\MCQs;
use App\Models\PackageData;
use App\Models\PackageDetails;
use App\Models\ReadableDocuments;
use App\Models\StudentAttendance;
use App\Models\StudentBatch;
use App\Models\StudentBatchToCourses;
use App\Models\StudentBatchToStudent;
use App\Models\Subjects;
use App\Models\SubSubTopics;
use App\Models\SubTopics;
use App\Models\Topics;
use App\Models\User;
use App\Models\Videos;
use Illuminate\Http\Request;
use Validator;

class ResourcesData extends Controller
{

    //videos
    public function videos()
    {
        $allVideos = Videos::where('videos.status', '1')
            ->get([
                'videos.*',
            ]);

        if (count($allVideos) == 0) {} else {

            foreach ($allVideos as $key => $value) {
                $value->subject_name = Subjects::where('id', $value->subject_id)->select('name')->first()->name;
                $value->topic_name = Topics::where('id', $value->topic_id)->select('name')->first()->name;

                if ($value->sub_topic_id != 'NA' && $value->sub_topic_id != -1) {
                    $value->sub_topic_name = SubTopics::where('id', $value->sub_topic_id)->select('name')->first()->name;
                } else {
                    $value->sub_topic_name = 'NA';
                }
                if ($value->sub_sub_topic_id != 'NA' && $value->sub_sub_topic_id != -1) {
                    $value->sub_sub_topic_name = SubSubTopics::where('id', $value->sub_sub_topic_id)->select('name')->first()->name;
                } else {
                    $value->sub_sub_topic_name = 'NA';
                }
            }
        }
        $allSubjects = Subjects::where('status', '1')->select()->get();
        return view('adminPages.videos', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allVideos' => $allVideos,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addVideos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'video_url' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else if ($nameError->has('video_url')) {
                $nameError = 'Yu need to add video URL';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }
        // print_r($this->get_youtube($request->video_url));
        // die();

        $video = new Videos();
        $video->subject_id = $request->subject_id;
        $video->topic_id = $request->topic_id;
        $video->sub_topic_id = isset($request->sub_topic_id) ? $request->sub_topic_id : 'NA';
        $video->sub_sub_topic_id = isset($request->sub_sub_topic_id) ? $request->sub_sub_topic_id : 'NA';
        $video->description = 'NA';
        $video->title = $this->get_youtube($request->video_url)['title'];
        $video->video_url = $request->video_url;
        $video->status = '1';
        $video->save();

        return back()->with('message', 'Video Added Successfully');

    }

    public function get_youtube($url)
    {

        $youtube = "https://www.youtube.com/oembed?url=" . $url . "&format=json";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }

    public function editVideo(Request $request)
    {

        $selectSubCatId = Videos::where('id', $request->id)->select()->first();

        $allVideos = Videos::join('subjects', 'videos.subject_id', '=', 'subjects.id')
            ->join('topics', 'videos.topic_id', '=', 'topics.id')
            ->where('videos.status', '1');

        // Conditionally add the join for sub_topics
        if ($selectSubCatId->sub_topic_id == 'NA') {
            $allVideos->join('sub_topics', 'videos.sub_topic_id', '=', 'sub_topics.id');
        }

        // Conditionally add the join for sub_sub_topics
        if ($selectSubCatId->sub_sub_topic_id == 'NA') {
            $allVideos->join('sub_sub_topics', 'videos.sub_sub_topic_id', '=', 'sub_sub_topics.id');
        }

        $allVideos->get([
            'videos.*',
            'subjects.name as subject_name',
            'topics.name as topic_name',
            'sub_topics.name as sub_topic_name',
            'sub_sub_topics.name as sub_sub_topic_name',
        ]);

        $allSubjects = Subjects::where('status', '1')->select()->get();
        $allTopics = Topics::where('subject_id', $selectSubCatId->subject_id)->select()->get();
        $allSubTopics = SubTopics::where('topic_id', $selectSubCatId->topic_id)->select()->get();
        $allSubSubTopics = SubSubTopics::where('sub_topic_id', $selectSubCatId->sub_topic_id)->select()->get();

        return view('adminPages.videos', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allVideos' => $allVideos,
            'selectSubCatId' => $selectSubCatId,
            'selectCatId' => null,
            'allTopics' => $allTopics,
            'allSubTopics' => $allSubTopics,
            'allSubSubTopics' => $allSubSubTopics,

            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'video_url' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else if ($nameError->has('video_url')) {
                $nameError = 'You need to add video URL';
            } else {
                $nameError = 'Subject image required';
            }
            return back()->with('error', $nameError);
        }

        $video = Videos::find($request->id);
        $video->subject_id = $request->subject_id;
        $video->topic_id = $request->topic_id;
        $video->sub_topic_id = $request->sub_topic_id;
        $video->sub_sub_topic_id = $request->sub_sub_topic_id;
        $video->description = 'NA';
        $video->title = 'NA';
        $video->video_url = $request->video_url;
        $video->status = '1';
        $video->save();

        return redirect('videos')->with('message', 'Video Successfully Updated.');
    }

    public function deleteVideo(Request $request)
    {
        $checkforInclutioninPackageData = PackageData::where('data_type', 'video')->where('data_id', $request->id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'Video cannot be deleted because it is in use in a package');
        }

        $video = Videos::find($request->id);
        $video->status = '0';
        $video->save();

        return redirect('videos')->with('message', 'Video Successfully Deleted.');
    }
    //mcqs
    public function mcqs()
    {

        $allSubjects = Subjects::where('status', '1')->select()->get();

        $allBatches = MCQs::groupBy('batch_id')->groupBy('title')
            ->groupBy('subject_id')
            ->groupBy('topic_id')
            ->groupBy('sub_topic_id')
            ->groupBy('sub_sub_topic_id')

            ->select('batch_id', 'title', 'subject_id', 'topic_id', 'sub_topic_id', 'sub_sub_topic_id')
            ->get();

        foreach ($allBatches as $batch) {
            $batch->subject_name = Subjects::where('id', $batch->subject_id)->first()->name;
            $batch->topic_name = Topics::where('id', $batch->topic_id)->first()->name;

            if ($batch->sub_topic_id == 'NA' || $batch->sub_topic_id == '-1') {
                $batch->sub_topic_name = 'NA';
            } else {
                $batch->sub_topic_name = SubTopics::where('id', $batch->sub_topic_id)->first()->name;
            }
            if ($batch->sub_sub_topic_id == 'NA' || $batch->sub_sub_topic_id == '-1') {
                $batch->sub_sub_topic_name = 'NA';
            } else {
                $batch->sub_sub_topic_name = SubSubTopics::where('id', $batch->sub_sub_topic_id)->first()->name;
            }

        }

        return view('adminPages.mcqs', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allBatches' => $allBatches,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addMcqPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'name' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else if ($nameError->has('name')) {
                $nameError = 'You need to add title';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        //genrate a random ALPHA Numric
        $batch_id = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);

        $checkforDuplicity = MCQs::where('batch_id', $batch_id)->select()->first();
        while ($checkforDuplicity) {
            $batch_id = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);
            $checkforDuplicity = MCQs::where('batch_id', $batch_id)->select()->first();
        }

        //process the csv file and save the data
        $title = $request->name;
        $subject = $request->subject_id;
        $topic = $request->topic_id;
        $subTopic = $request->sub_topic_id;
        $sub_sub_topic_id = $request->sub_sub_topic_id;

        if ($request->hasFile('csv')) {
            $csvFilePath = $request->file('csv')->path();
            $image = $request->file('csv');
            $name = $batch_id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/mcqcsv/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/mcqcsv/' . $name;
            $response = $this->processMCQCSV($batch_id, $title, $subject, $topic, $subTopic, $sub_sub_topic_id, $csvFilePath);

            if ($response['error'] == null) {
                return back()->with('message', $response['inserted'] . ' Inserted out of ' . $response['totalCount'] . ' Successfully.');

            } else {
                return back()->with('error', $response['inserted'] . ' Inserted out of ' . $response['totalCount'] . ' error occured ' . $response['error']);
            }
        } else {
            return back()->with('error', 'You need to add file');
        }

    }

    public function processMCQCSV($batch_id, $title, $subject, $topic, $subTopic, $sub_sub_topic_id)
    {
        // Read the CSV file
        $csvFilePath = public_path('upload/mcqcsv/' . $batch_id . '.csv');
        $csvData = file_get_contents($csvFilePath);

        // Parse CSV data into an array of associative arrays
        $csvRows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($csvRows); // Remove header from rows

        // Ensure header exists and has at least one column
        if (!$header || count($header) < 1) {
            return back()->with('error', 'CSV header is missing or empty');
        }

        // Process each row and insert into the database
        // Process each row and insert into the database

        $totalCount = count($csvRows);
        $count = 0;
        foreach ($csvRows as $rowIndex => $row) {
            try {

                // echo ('Header: ' . json_encode($header));
                // echo ('Row ' . ($rowIndex + 1) . ': ' . json_encode($row));
                if (count($row) !== count($header)) {

                    // echo '<br/>Count Row :' . count($row) . '<br/>Count header :' . count($header) . '<br/>Number of columns in data row ' . ($rowIndex + 1) . ' does not match the header';
                    return array(
                        'inserted' => $count,
                        'totalCount' => $totalCount,
                        'error' => 'Number of columns in data row ' . ($rowIndex + 1) . ' does not match the header',
                    );
                    // return back()->with('error', );
                }

                // for ($i = 0; $i < count($header); $i++) {
                //     echo '<br/>' . $header[$i] . ' : ' . $row[$i];
                // }
                // Create an associative array of column names and values for the current row
                $rowData = array_combine($header, $row);

                // echo "Row " . $rowIndex;

                // Create a new MCQ model instance
                MCQs::create([
                    'batch_id' => $batch_id,
                    'title' => $title,
                    'subject_id' => $subject,
                    'topic_id' => $topic,
                    'sub_topic_id' => $subTopic,
                    'sub_sub_topic_id' => $sub_sub_topic_id,
                    'question_text' => htmlspecialchars($rowData['question_text'] ?? 'NA'),
                    'question_image' => $rowData['question_image'] ?? 'NA',
                    'correct_answer' => $rowData['correct_answer'] ?? 'NA',
                    'option_1_text' => htmlspecialchars($rowData['option_1_text'] ?? 'NA'),
                    'option_2_text' => htmlspecialchars($rowData['option_2_text'] ?? 'NA'),
                    'option_3_text' => htmlspecialchars($rowData['option_3_text'] ?? 'NA'),
                    'option_4_text' => htmlspecialchars($rowData['option_4_text'] ?? 'NA'),
                    'option_1_image' => $rowData['option_1_image'] ?? 'NA',
                    'option_2_image' => $rowData['option_2_image'] ?? 'NA',
                    'option_3_image' => $rowData['option_3_image'] ?? 'NA',
                    'option_4_image' => $rowData['option_4_image'] ?? 'NA',
                    'answer_explanation_text' => htmlspecialchars($rowData['answer_explanation_text'] ?? 'NA'),
                    'answer_explanation_image' => $rowData['answer_explanation_image'] ?? 'NA',
                ]);

                $count = $count + 1;

                // // Create a new MCQ model instance

                // $insertData = [
                //     'batch_id' => $batch_id,
                //     'title' => $title,
                //     'subject_id' => $subject,
                //     'topic_id' => $topic,
                //     'sub_topic_id' => $subTopic,
                //     'sub_sub_topic_id' => $sub_sub_topic_id,
                //     'question_text' => $rowData['question_text'] ?? 'NA',
                //     'question_image' => $rowData['question_image'] ?? 'NA',
                //     'correct_answer' => $rowData['correct_answer'] ?? 'NA',
                //     'option_1_text' => $rowData['option_1_text'] ?? 'NA',
                //     'option_2_text' => $rowData['option_2_text'] ?? 'NA',
                //     'option_3_text' => $rowData['option_3_text'] ?? 'NA',
                //     'option_4_text' => $rowData['option_4_text'] ?? 'NA',
                //     'option_1_image' => $rowData['option_1_image'] ?? 'NA',
                //     'option_2_image' => $rowData['option_2_image'] ?? 'NA',
                //     'option_3_image' => $rowData['option_3_image'] ?? 'NA',
                //     'option_4_image' => $rowData['option_4_image'] ?? 'NA',
                //     'answer_explanation_text' => $rowData['answer_explanation_text'] ?? 'NA',
                //     'answer_explanation_image' => $rowData['answer_explanation_image'] ?? 'NA',
                // ];

                // $columns = implode(', ', array_keys($insertData));
                // $values = implode(', ', array_map(function ($value) {
                //     return is_string($value) ? "'" . addslashes($value) . "'" : $value;
                // }, array_values($insertData)));

                // $mysqlQuery = "INSERT INTO m_c_qs ($columns) VALUES ($values)";

                // echo $mysqlQuery;
                // die;
            } catch (\Exception $e) {
                return array(
                    'inserted' => $count,
                    'totalCount' => $totalCount,
                    'error' => $e->getMessage(),
                );

            }

        }
        return array(
            'inserted' => $count,
            'totalCount' => $totalCount,
            'error' => null,
        );

    }

    public function editMcq(Request $request)
    {

        $allSubjects = Subjects::where('status', '1')->select()->get();

        $selectSubCatId = MCQs::where('batch_id', $request->id)->select()->first();
        $allTopics = Topics::where('subject_id', $selectSubCatId->subject_id)->select()->get();
        $allSubTopics = SubTopics::where('topic_id', $selectSubCatId->topic_id)->select()->get();
        $allSubSubTopics = SubSubTopics::where('sub_topic_id', $selectSubCatId->sub_topic_id)->select()->get();

        $allBatches = MCQs::groupBy('batch_id')->groupBy('title')
            ->groupBy('subject_id')
            ->groupBy('topic_id')
            ->groupBy('sub_topic_id')
            ->groupBy('sub_sub_topic_id')

            ->select('batch_id', 'title', 'subject_id', 'topic_id', 'sub_topic_id', 'sub_sub_topic_id')
            ->get();

        foreach ($allBatches as $batch) {
            $batch->subject_name = Subjects::where('id', $batch->subject_id)->first()->name;
            $batch->topic_name = Topics::where('id', $batch->topic_id)->first()->name;

            if ($batch->sub_topic_id == 'NA' || $batch->sub_topic_id == '-1') {
                $batch->sub_topic_name = 'NA';
            } else {
                $batch->sub_topic_name = SubTopics::where('id', $batch->sub_topic_id)->first()->name;
            }
            if ($batch->sub_sub_topic_id == 'NA' || $batch->sub_sub_topic_id == '-1') {
                $batch->sub_sub_topic_name = 'NA';
            } else {
                $batch->sub_sub_topic_name = SubSubTopics::where('id', $batch->sub_sub_topic_id)->first()->name;
            }

        }

        return view('adminPages.mcqs', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allBatches' => $allBatches,
            'selectSubCatId' => $selectSubCatId,
            'selectCatId' => null,
            'allTopics' => $allTopics,
            'allSubTopics' => $allSubTopics,
            'allSubSubTopics' => $allSubSubTopics,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    //pdf
    public function pdfs()
    {
        $allSubjects = Subjects::where('status', '1')->select()->get();

        $allpdfs = ReadableDocuments::where('readable_documents.status', '1')
            ->get([
                'readable_documents.*',
            ]);

        foreach ($allpdfs as $key => $value) {
            $value->subject_name = Subjects::where('id', $value->subject_id)->select('name')->first()->name;
            
            try {
                $value->topic_name = Topics::where('id', $value->topic_id)->select('name')->first()->name;
            } catch (\Exception $e) {
                $value->topic_name = 'NA';
            }
            
            
            if ($value->sub_topic_id != 'NA' && $value->sub_topic_id != -1) {
                $value->sub_topic_name = SubTopics::where('id', $value->sub_topic_id)->select('name')->first()->name;
            } else {
                $value->sub_topic_name = 'NA';
            }
            if ($value->sub_sub_topic_id != 'NA' && $value->sub_sub_topic_id != -1) {
                $value->sub_sub_topic_name = SubSubTopics::where('id', $value->sub_sub_topic_id)->select('name')->first()->name;
            } else {
                $value->sub_sub_topic_name = 'NA';
            }
        }

        return view('adminPages.pdfs', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allpdfs' => $allpdfs,
            'selectSubCatId' => null,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function deleteMcq(Request $request)
    {
        $checkforInclutioninPackageData = PackageData::where('data_type', 'mcq')->where('data_id', $request->id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'MCQ cannot be deleted because it is in use in a package');
        }
        $pdf = MCQs::where('batch_id', $request->id);
        $pdf->delete();

        return redirect('mcqs')->with('message', 'MCQ Deleted Successfully Deleted.');
    }

    public function updateMcq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'name' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else if ($nameError->has('name')) {
                $nameError = 'You need to add title';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }
        if ($request->hasFile('csv')) {

            //delete existing mcqs
            $pdf = MCQs::where('batch_id', $request->id);
            $pdf->delete();
            //delete existing file
            $image_path = public_path('upload/mcqcsv/' . $request->id . '.csv');
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $csvFilePath = $request->file('csv')->path();
            $image = $request->file('csv');
            $name = $batch_id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/mcqcsv/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/mcqcsv/' . $name;
            $this->processMCQCSV($batch_id, $title, $subject, $topic, $subTopic, $sub_sub_topic_id, $csvFilePath);
            return back()->with('message', 'MCQs Updated Successfully');
        } else {
            //Update the mcqs Static Details
            $mcq = MCQs::where('batch_id', $request->id)->update([
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'sub_topic_id' => isset($request->sub_topic_id) ? $request->sub_topic_id : 'NA',
                'sub_sub_topic_id' => isset($request->sub_sub_topic_id) ? $request->sub_sub_topic_id : 'NA',
                'title' => $request->name,
            ]);

            return back()->with('message', 'MCQs Updated Successfully');
        }

    }

    public function addPdfs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'title' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }
        $pdf = new ReadableDocuments();

        if ($request->hasFile('file_url')) {
            $image = $request->file('file_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/readabledocument/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/readabledocument/' . $name;
            $pdf->file_url = $imagePath;
        } else {
            return back()->with('error', 'You need to add file');
        }

        $pdf->subject_id = $request->subject_id;
        $pdf->topic_id = $request->topic_id;
        $pdf->sub_topic_id = isset($request->sub_topic_id) ? $request->sub_topic_id : 'NA';
        $pdf->sub_sub_topic_id = isset($request->sub_sub_topic_id) ? $request->sub_sub_topic_id : 'NA';
        $pdf->description = 'NA';
        $pdf->title = $request->title;
        $pdf->status = '1';
        $pdf->save();

        return back()->with('message', 'PDF Added Successfully');
    }

    public function editPdf(Request $request)
    {
        $selectSubCatId = ReadableDocuments::where('id', $request->id)->select()->first();

        $allTopics = Topics::where('subject_id', $selectSubCatId->subject_id)->select()->get();
        $allSubTopics = SubTopics::where('topic_id', $selectSubCatId->topic_id)->select()->get();
        $allSubSubTopics = SubSubTopics::where('sub_topic_id', $selectSubCatId->sub_topic_id)->select()->get();

        $allpdfs = ReadableDocuments::where('readable_documents.status', '1')
            ->get([
                'readable_documents.*',
            ]);

        foreach ($allpdfs as $key => $value) {
            $value->subject_name = Subjects::where('id', $value->subject_id)->select('name')->first()->name;
            $value->topic_name = Topics::where('id', $value->topic_id)->select('name')->first()->name;

            if ($value->sub_topic_id != 'NA' && $value->sub_topic_id != -1) {
                $value->sub_topic_name = SubTopics::where('id', $value->sub_topic_id)->select('name')->first()->name;
            } else {
                $value->sub_topic_name = 'NA';
            }
            if ($value->sub_sub_topic_id != 'NA' && $value->sub_sub_topic_id != -1) {
                $value->sub_sub_topic_name = SubSubTopics::where('id', $value->sub_sub_topic_id)->select('name')->first()->name;
            } else {
                $value->sub_sub_topic_name = 'NA';
            }
        }

        $allSubjects = Subjects::where('status', '1')->select()->get();

        return view('adminPages.pdfs', [
            'title' => 'AdminPortal | Add problem Category',
            'allSubjects' => $allSubjects,
            'allpdfs' => $allpdfs,
            'selectSubCatId' => $selectSubCatId,
            'selectCatId' => null,
            'allTopics' => $allTopics,
            'allSubTopics' => $allSubTopics,
            'allSubSubTopics' => $allSubSubTopics,
            'selectCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);

    }

    public function updatePdf(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'title' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('subject_id')) {
                $nameError = 'You need to select Subject first';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select Topic first';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $pdf = ReadableDocuments::find($request->id);

        if ($request->hasFile('file_url')) {
            $image = $request->file('file_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/readabledocument/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/readabledocument/' . $name;
            $pdf->file_url = $imagePath;
        }

        $pdf->subject_id = $request->subject_id;
        $pdf->topic_id = $request->topic_id;

        if ($request->sub_sub_topic_id == 'NA' || $request->sub_sub_topic_id == -1) {
            $pdf->sub_sub_topic_id = 'NA';
        } else {
            $pdf->sub_sub_topic_id = $request->sub_sub_topic_id;
        }
        if ($request->sub_topic_id == 'NA' || $request->sub_topic_id == -1) {
            $pdf->sub_topic_id = 'NA';
        } else {
            $pdf->sub_topic_id = $request->sub_topic_id;
        }
        $pdf->description = 'NA';
        $pdf->title = $request->title;
        $pdf->status = '1';
        $pdf->save();

        // echo $pdf;
        // die;

        return redirect('pdf')->with('message', 'PDF Successfully Updated.');
    }

    public function deletePdf(Request $request)
    {
        $checkforInclutioninPackageData = PackageData::where('data_type', 'pdf')->where('data_id', $request->id)->first();
        if ($checkforInclutioninPackageData) {
            return back()->with('error', 'PDF cannot be deleted because it is in use in a package');
        }

        $pdf = ReadableDocuments::find($request->id);
        $pdf->status = '0';
        $pdf->save();

        return redirect('pdf')->with('message', 'PDF Successfully Deleted.');
    }

    //gallery
    public function gallery()
    {
        $allPhotos = Gallery::all();
        return view('adminPages.gallery', [
            'title' => 'AdminPortal | Add problem Category',
            'allPhotos' => $allPhotos,
            'alertDescription' => null,
            'selectSubCatId' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addGallery(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('title')) {
                $nameError = 'You need to add title';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->alttitle = $request->alttitle;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/gallery/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/gallery/' . $name;
            $gallery->file_url = $imagePath;
        } else {
            return back()->with('error', 'You need to add image');
        }
        $gallery->save();
        return back()->with('success', 'Image Added Successfully');
    }

    public function deleteGallery(Request $request)
    {
        $gallery = Gallery::find($request->id);
        $gallery->delete();
        return redirect('gallery')->with('message', 'Image Successfully Deleted.');
    }

    //edit gallery
    public function editGallery(Request $request)
    {
        $selectSubCatId = Gallery::where('id', $request->id)->select()->first();
        $allPhotos = Gallery::all();
        return view('adminPages.gallery', [
            'title' => 'AdminPortal | Add problem Category',
            'allPhotos' => $allPhotos,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateGallery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('title')) {
                $nameError = 'You need to add title';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $gallery = Gallery::find($request->id);
        $gallery->title = $request->title;
        $gallery->alttitle = $request->alttitle;
        if ($request->hasFile('image')) {
            //delete the previous image
            $image_path = $gallery->file_url;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/gallery/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/gallery/' . $name;
            $gallery->file_url = $imagePath;
        }
        $gallery->save();
        return redirect('gallery')->with('message', 'Image Successfully Updated.');
    }

    public function packages()
    {
        //generate Random Alphanumeric Code
        $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);

        // check duplicates in packages
        $checkforDuplicity = PackageDetails::where('package_code', $package_code)->select()->first();
        while ($checkforDuplicity) {
            $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);
            $checkforDuplicity = PackageDetails::where('package_code', $package_code)->select()->first();
        }

        $allpackages = PackageDetails::all();

        return view('adminPages.packages', [
            'title' => 'AdminPortal | Add problem Category',
            'package_code' => $package_code,
            'allpackages' => $allpackages,
            'alertDescription' => null,
            'selectSubCatId' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addPackagePost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'package_code' => 'required|min:1',
            'title' => 'required|min:1',
            'package_price' => 'required|min:1',
            'package_duration' => 'required|min:1',
            'package_description' => 'required|min:1',
            'status' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('package_code')) {
                $nameError = 'You need to add package code';
            } else if ($nameError->has('title')) {
                $nameError = 'You need to add title';
            } else if ($nameError->has('package_price')) {
                $nameError = 'You need to add package price';
            } else if ($nameError->has('package_duration')) {
                $nameError = 'You need to add package duration';
            } else if ($nameError->has('status')) {
                $nameError = 'You need to add status';
            } else if ($nameError->has('package_description')) {
                $nameError = 'You need to add Package Description';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $package = new PackageDetails();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/packages/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/packages/' . $name;
            $package->package_image = $imagePath;
        }
        $package->package_code = $request->package_code;
        $package->package_name = $request->title;
        $package->package_description = $request->package_description;
        $package->package_price = $request->package_price;
        $package->package_duration = $request->package_duration;
        $package->package_duration_type = 'NA';
        $package->package_type = 'NA';
        $package->package_status = '1';
        $package->save();
        return back()->with('message', 'Package Added Successfully');
    }

    public function deletePackage(Request $request)
    {
        $package = PackageDetails::find($request->id);

        if ($package->package_status == '1') {
            $package->package_status = '0';
            $package->save();
            return redirect('packages')->with('message', 'Package Successfully Suspended.');
        } else {
            $package->package_status = '1';
            $package->save();
            return redirect('packages')->with('message', 'Package Successfully Activated.');
        }
    }

    public function editPackage(Request $request)
    {
        $selectSubCatId = PackageDetails::where('id', $request->id)->select()->first();
        $allpackages = PackageDetails::all();
        return view('adminPages.packages', [
            'title' => 'AdminPortal | Add problem Category',
            'allpackages' => $allpackages,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updatePackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_code' => 'required|min:1',
            'title' => 'required|min:1',
            'package_price' => 'required|min:1',
            'package_duration' => 'required|min:1',
            'status' => 'required|min:1',
            'package_description' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('package_code')) {
                $nameError = 'You need to add package code';
            } else if ($nameError->has('title')) {
                $nameError = 'You need to add title';
            } else if ($nameError->has('package_price')) {
                $nameError = 'You need to add package price';
            } else if ($nameError->has('package_duration')) {
                $nameError = 'You need to add package duration';
            } else if ($nameError->has('status')) {
                $nameError = 'You need to add status';
            } else if ($nameError->has('package_description')) {
                $nameError = 'You need to add Package Description';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $package = PackageDetails::find($request->id);

        if ($request->hasFile('image')) {
            //delete the previous image
            $image_path = $package->package_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/packages/');
            $image->move($destinationPath, $name);
            $imagePath = 'upload/packages/' . $name;
            $package->package_image = $imagePath;
        }
        $package->package_code = $request->package_code;
        $package->package_name = $request->title;
        $package->package_description = $request->package_description;
        $package->package_price = $request->package_price;
        $package->package_duration = $request->package_duration;
        $package->package_duration_type = 'NA';
        $package->package_type = 'NA';
        $package->package_status = $request->status;
        $package->save();
        return redirect('packages')->with('message', 'Package Successfully Updated');

    }

    public function addpackagedata(Request $request)
    {
        $getPackageDetails = PackageDetails::where('id', $request->id)->select()->first();
        $allSubjects = Subjects::where('status', '1')->select()->get();

        $allData = PackageData::where('package_id', $getPackageDetails->id)
            ->where('package_code', $getPackageDetails->package_code)
            ->where('status', '1')
            ->select()
            ->get();
        if (count($allData) > 0) {

            foreach ($allData as $data) {
                $data->subject_name = Subjects::where('id', $data->subject_id)->select('name')->first()->name;

                $data->topic_name = Topics::where('id', $data->topic_id)->select('name')->first()->name;
                if ($data->sub_topic_id != 'NA' && $data->sub_topic_id != -1) {
                    $data->sub_topic_name = SubTopics::where('id', $data->sub_topic_id)->select('name')->first()->name;
                } else {
                    $data->sub_topic_name = 'NA';
                }
                if ($data->sub_sub_topic_id != 'NA' && $data->sub_sub_topic_id != -1) {
                    $data->sub_sub_topic_name = SubSubTopics::where('id', $data->sub_sub_topic_id)->select('name')->first()->name;
                } else {
                    $data->sub_sub_topic_name = 'NA';
                }

                if ($data->data_type == 'video') {
                    $data->data_title = Videos::where('id', $data->data_id)->select('title')->first()->title;
                }
                if ($data->data_type == 'mcq') {
                    if($data->batch_id != '')
                    $data->data_title = MCQs::where('batch_id', $data->data_id)->select('title')->first()->title;
                }
                if ($data->data_type == 'pdf') {
                    $data->data_title = ReadableDocuments::where('id', $data->data_id)->select('title')->first()->title;
                }
            }
        }

        return view('adminPages.addToPackage', [
            'title' => 'AdminPortal | Add problem Category',
            'getPackageDetails' => $getPackageDetails,
            'allSubjects' => $allSubjects,
            'allData' => $allData,
            'alertDescription' => null,
            'selectSubCatId' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function addpackagedataPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|min:1',
            'package_code' => 'required|min:1',
            'subject_id' => 'required|min:1',
            'topic_id' => 'required|min:1',
            'data_type' => 'required|min:1',
            'data_selection' => 'required|min:1',
            'include_file' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('package_id')) {
                $nameError = 'You need to select package';
            } else if ($nameError->has('package_code')) {
                $nameError = 'You need to add package code';
            } else if ($nameError->has('subject_id')) {
                $nameError = 'You need to select subject';
            } else if ($nameError->has('topic_id')) {
                $nameError = 'You need to select topic';
            } else if ($nameError->has('data_type')) {
                $nameError = 'You need to select data type';
            } else if ($nameError->has('data_id')) {
                $nameError = 'You need to select data';
            } else if ($nameError->has('include_file')) {
                $nameError = 'You need to select include file';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $dataIds = $request->data_selection;
        foreach ($dataIds as $id) {

            //Check for duplicity
            $existingData = PackageData::
                where('package_id', $request->package_id)
                ->where('package_code', $request->package_code)
                ->where('subject_id', $request->subject_id)
                ->where('topic_id', $request->topic_id)
                ->where('data_id', $id)
                ->where('data_type', $request->data_type)
                ->first();

            if ($existingData) {
            } else {
                $packageData = new PackageData();
                $packageData->package_id = $request->package_id;
                $packageData->package_code = $request->package_code;
                $packageData->subject_id = $request->subject_id;
                $packageData->topic_id = $request->topic_id;

                if ($request->sub_topic_id != '-1') {
                    $packageData->sub_topic_id = $request->sub_topic_id;
                } else {
                    $packageData->sub_topic_id = 'NA';
                }
                if ($request->sub_sub_topic_id != '-1') {
                    $packageData->sub_sub_topic_id = $request->sub_sub_topic_id;
                } else {
                    $packageData->sub_sub_topic_id = 'NA';
                }
                $packageData->data_id = $id;
                $packageData->data_type = $request->data_type;
                $packageData->include_file = $request->include_file;
                $packageData->status = '1';
                $packageData->save();
            }
        }
        // echo 'Data Added Successfully';
        return back()->with('success', 'Data Added Successfully');

    }

    public function deletePackageDta(Request $request)
    {
        $packageData = PackageData::find($request->id);
        $packageData->delete();
        return back()->with('message', 'Data Deleted Successfully');

    }

    public function sLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:1',
            'password' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

    }

     public function viewStudents()
    {
        // $allStudents = User::leftjoin('user_profiles', 'users.id', '=', 'user_profiles.userId')
        //     ->join('role_user', 'users.id', 'role_user.user_id')
        //     ->where('role_user.role_id', 4)
        //     ->get([
        //         'users.id', 'users.name', 'users.email', 'users.phone', 'users.created_at',
        //          'user_profiles.fathersname', 'user_profiles.mothersname', 'user_profiles.fathersphone', 'user_profiles.mothersphone'
        //     ]);
        
    $allStudents = User::leftjoin('user_profiles', 'users.id', '=', 'user_profiles.userId')
            ->join('role_user', 'users.id', 'role_user.user_id')
            ->where('role_user.role_id', 4)
            ->get([
                'users.id', 'users.name', 'users.phone', 'users.email','user_profiles.fathersname', 'user_profiles.fathersphone'
            ]);

            // echo $allStudents;
            // die;


        $batches = StudentBatch::all();

        return view('adminPages.viewStudents', [
            'title' => 'AdminPortal | Add problem Category',
            'allStudents' => $allStudents,
            'allBatch' => $batches,

            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function batch()
    {
        $allBatch = StudentBatch::all();
        $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);

        $packages = PackageDetails::where('package_status', '1')->get();

        // check duplicates in packages
        $checkforDuplicity = StudentBatch::where('batchId', $package_code)->select()->first();
        while ($checkforDuplicity) {
            $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);
            $checkforDuplicity = StudentBatch::where('batchId', $package_code)->select()->first();
        }

        $batches = StudentBatch::all();

        foreach ($batches as $batch) {
            $batch['courses'] = StudentBatchToCourses::join('package_details', 'package_details.id', 'student_batch_to_courses.packageId')
                ->where('student_batch_to_courses.batchId', $batch->batchId)->get([
                'package_details.id', 'package_code', 'package_name',
            ]);
        }

        return view('adminPages.batchs', [
            'title' => 'AdminPortal | Add problem Category',
            'allBatch' => $allBatch,
            'batchId' => $package_code,
            'allpackages' => $packages,
            'batches' => $batches,
            'alertDescription' => null,
            'selectSubCatId' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function batchPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'batchId' => 'required|min:1',
            'batchName' => 'required|min:1',
            'startDate' => 'required|min:1',
            'endDate' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('batchId')) {
                $nameError = 'Batch Id is required';
            } else if ($nameError->has('batchName')) {
                $nameError = 'You need to add batch Name';
            } else if ($nameError->has('startDate')) {
                $nameError = 'You need to select start Date';
            } else if ($nameError->has('endDate')) {
                $nameError = 'You need to select end Date';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        for ($i = 0; $i < count($request->packages); $i++) {
            $package = $request->packages[$i];
            $batchpackage = new StudentBatchToCourses();
            $batchpackage->batchId = $request->batchId;
            $batchpackage->packageId = $package;
            $batchpackage->save();
        }

        $batch = new StudentBatch();
        $batch->batchId = $request->batchId;
        $batch->batchName = $request->batchName;
        $batch->startDate = $request->startDate;
        $batch->endDate = $request->endDate;
        $batch->save();
        return back()->with('message', 'Batch Added Successfully');
    }

    public function editbatch($id)
    {
        $batch = StudentBatch::find($id);

        $allCoursesforthatbatch = StudentBatchToCourses::where('batchId', $batch->batchId)->pluck('packageId')->toArray();

        $batch->packages = $allCoursesforthatbatch;

        // echo  $batch;
        // die;

        $allBatch = StudentBatch::all();
        $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);

        $packages = PackageDetails::where('package_status', '1')->get();

        // check duplicates in packages
        $checkforDuplicity = StudentBatch::where('batchId', $package_code)->select()->first();
        while ($checkforDuplicity) {
            $package_code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, 6);
            $checkforDuplicity = StudentBatch::where('batchId', $package_code)->select()->first();
        }

        $batches = StudentBatch::all();

        foreach ($batches as $batch) {
            $batch['courses'] = StudentBatchToCourses::join('package_details', 'package_details.id', 'student_batch_to_courses.packageId')
                ->where('student_batch_to_courses.batchId', $batch->batchId)->get([
                'package_details.id', 'package_code', 'package_name',
            ]);
        }

        return view('adminPages.batchs', [
            'title' => 'AdminPortal | Add problem Category',
            'allBatch' => $allBatch,
            'batchId' => $package_code,
            'allpackages' => $packages,
            'batches' => $batches,
            'alertDescription' => null,
            'selectSubCatId' => $batch,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function editbatchPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'batchId' => 'required|min:1',
            'batchName' => 'required|min:1',
            'startDate' => 'required|min:1',
            'endDate' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('batchId')) {
                $nameError = 'Batch Id is required';
            } else if ($nameError->has('batchName')) {
                $nameError = 'You need to add batch Name';
            } else if ($nameError->has('startDate')) {
                $nameError = 'You need to select start Date';
            } else if ($nameError->has('endDate')) {
                $nameError = 'You need to select end Date';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        if ($request->packages != "") {
            $deleteaAllPreviouspackage = StudentBatchToCourses::where('batchId', $request->batchId)->delete();

            for ($i = 0; $i < count($request->packages); $i++) {
                $package = $request->packages[$i];
                $batchpackage = new StudentBatchToCourses();
                $batchpackage->batchId = $request->batchId;
                $batchpackage->packageId = $package;
                $batchpackage->save();
            }
        }

        $batch = StudentBatch::where('batchId', $request->batchId)->first();
        $batch->batchId = $request->batchId;
        $batch->batchName = $request->batchName;
        $batch->startDate = $request->startDate;
        $batch->endDate = $request->endDate;
        $batch->save();
        return back()->with('message', 'Batch Updated Successfully');
    }

    public function viewStidentsinBatch($batchId)
    {
        $batch = StudentBatch::where('id', $batchId)->first();
        // $getBatchStudents = StudentBatchToStudent::join('users', 'users.id', 'student_batch_to_students.studentId')
        //     ->join('user_profiles', 'users.id', 'user_profiles.userId')
        //     ->where('batchId', $batch->batchId)->get([
        //     'users.id', 'users.name', 'users.email', 'users.phone', 'user_profiles.fathersname', 'user_profiles.fathersphone', 'student_batch_to_students.batchId',
        // ]);
        
         $getBatchStudents= StudentBatchToStudent::where('batchId', $batch->batchId)
            ->join('users', 'users.id', 'student_batch_to_students.studentId')
            ->leftjoin('user_profiles', 'users.id', 'user_profiles.userId')
            ->select('users.id', 'users.name', 'users.email', 'users.phone', 'user_profiles.fathersname', 'user_profiles.fathersphone', 'student_batch_to_students.batchId')
        ->get();

        return view('adminPages.batchStudents', [
            'allBatchStudents' => $getBatchStudents,
            'batch' => $batch,
        ]);
    }

    public function deleteStidentsinBatch($studentId, $batchId)
    {
        $batch = StudentBatchToStudent::where('studentId', $studentId)->where('batchId', $batchId)->delete();
        // echo $batchId;
        return back()->with('message', 'Student Deleted From The batch.');
    }

    public function cfs()
    {
        $allBanners = Banners::where('category', 'contact')->get();

        return view('adminPages.cfs', [
            'allBanners' => $allBanners,
        ]);
    }

    public function markattendance($batchId)
    {
        $batch = StudentBatch::where('id', $batchId)->first();
        $getBatchStudents = StudentBatchToStudent::join('users', 'users.id', 'student_batch_to_students.studentId')
            ->join('user_profiles', 'users.id', 'user_profiles.userId')
            ->where('batchId', $batch->batchId)->get([
            'users.id', 'users.name', 'users.email', 'users.phone', 'user_profiles.fathersname', 'user_profiles.fathersphone', 'student_batch_to_students.batchId',
        ]);

        $courses = StudentBatchToCourses::join('package_details', 'package_details.id', 'student_batch_to_courses.packageId')->where('batchId', $batch->batchId)->get();

        return view('adminPages.markattendance', [
            'allBatchStudents' => $getBatchStudents,
            'batch' => $batch,
            'courses' => $courses,
            'selectSubCatId' => null,
        ]);

    }

    public function markattendancePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'batchId' => 'required|min:1',
            'date' => 'required|min:1',
            'courseId' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $nameError = $validator->errors();
            if ($nameError->has('batchId')) {
                $nameError = 'Batch Id is required';
            } elseif ($nameError->has('date')) {
                $nameError = 'You need to select Date';
            } elseif ($nameError->has('courseId')) {
                $nameError = 'You need to select Course';
            } else {
                $nameError = 'Something went wrong';
            }
            return back()->with('error', $nameError);
        }

        $date = $request->date;
        $batchId = $request->batchId;
        $students = $request->selected_students;

        // All students of the batch
        $batch = StudentBatch::where('id', $batchId)->first();
        $enrolledStudents = StudentBatchToStudent::where('batchId', $batch->batchId)->get();
        if (count($enrolledStudents) == 0) {
            return back()->with('error', 'No Student Enrolled in this batch');
        }

        foreach ($enrolledStudents as $student) {
            $attendance = StudentAttendance::updateOrCreate(
                [
                    'batchId' => $batchId,
                    'studentId' => $student->studentId,
                    'courseId' => $request->courseId,
                    'date' => $date,
                ],
                [
                    'attendance' => in_array($student->studentId, $students) ? '1' : '0',
                ]
            );
        }

        return back()->with('message', 'Attendance Marked Successfully');
    }

}
