<?php
namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\ChangesUpdatedByUser;
use App\Models\MCQanswersbyuser;
use App\Models\MCQs;
use App\Models\NewChanges;
use App\Models\PackageData;
use App\Models\PackageDetails;
use App\Models\ReadableDocuments;
use App\Models\StudentBatchToCourses;
use App\Models\StudentBatchToStudent;
use App\Models\Subjects;
use App\Models\Topics;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Usermcqresult;
use App\Models\UserPackages;
use App\Models\UserProfile;
use App\Models\Videos;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;
use Validator;

class AppApiController extends Controller
{
    //

    public function login(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'phone_no' => 'required|digits:10',
            'password' => 'required',
            // "fcm_token" => "required",
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([[
                'status'  => 'error',
                'message' => $messages,
            ]], 200);
        }

        $user = User::where('phone', $request->phone_no)->first();
        if (! $user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not registered.',
            ], $status = 200, );
        }
        if (Hash::check($request->password, $user->password)) {
            $user->fcm_token = $request->fcm_token;
            $user->save();

            // $user->attachRole('customer');

            $token = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status'  => 'success',
                'message' => 'User logged in successfully.',
                'token'   => $token,
                'user'    => $user,
            ], $status = 200, );
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Credentials.',
            ], $status = 200, );
        }

    }

    public function allcourses()
    {
        $courses = PackageDetails::where('package_status', 1)->get();
        // send as json
        // header('Content-Type: application/json');
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => $courses,
        ], 200);
    }

    public function checkUserPack($packageId)
    {
        $user = Auth::user();
        //check purchasedcourse
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();
        //checck allocatedcourses
        // Check the batches of the user
        $userBatches                      = StudentBatchToStudent::where('studentId', $user->id)->get();
        $checkcoursesallocatedtothatBatch = [];
        $userEnrolledPackages             = [];

        foreach ($userBatches as $batch) {
            $checkcoursesallocatedtothatBatch[] = StudentBatchToCourses::where('batchId', $batch->batchId)->pluck('packageId')->toArray();
        }

        for ($i = 0; $i < count($checkcoursesallocatedtothatBatch); $i++) {
            $userEnrolledPackages = array_merge($userPackages, $checkcoursesallocatedtothatBatch[$i]);
        }

        for ($i = 0; $i < count($userEnrolledPackages); $i++) {
            $userEnrolledPackages = array_unique($userEnrolledPackages);
        }

        if (in_array($packageId, $userEnrolledPackages)) {
            return true;

        } else {
            return false;
        }
    }

    public function getpdf(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'pdfId'     => 'required',
            'packageId' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([[
                'status'  => 'error',
                'message' => $messages,
            ]], 200);
        }

        $packageId = $request->packageId;

        if (! $this->checkUserPack($packageId)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not enrolled in this course',
            ], 200);
        }

        $pdfId      = $request->pdfId;
        $pdfDetails = ReadableDocuments::where('id', $pdfId)->first();

        if (! $pdfDetails) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        // Get the file path from the PDF details
        $filePath = public_path($pdfDetails->file_url);

        // Check if the file exists in the public directory
        if (! File::exists($filePath)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'File not found',
            ], 404);
        }

        // Read the file content from the public directory
        $fileContent = File::get($filePath);

        // // Convert the file content to Binary
        // // send it as blob
        // $binaryFile = $fileContent;
        // // send the hexstring to the frontend
        // $hexFile = bin2hex($fileContent);

        // Convert the file content to Base64
        $base64File = base64_encode($fileContent);

        // Return the JSON response with the Base64 string
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => [
                'pdfDetails' => $pdfDetails,
                'base64File' => $base64File,
            ],
        ], 200);
    }

    public function appBanners()
    {
        $appBanners = Banners::where('category', 1)->where('status', 1)->get();
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => $appBanners,
        ], 200);

    }

    public function enrolledCourses()
    {
        $courses = PackageDetails::where('package_status', 1)->get();
        // send as json
        // header('Content-Type: application/json');
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => $courses,
        ], 200);
    }

    public function getSubjects($packageId)
    {
        $subjects = PackageData::
            join('subjects', 'package_data.subject_id', '=', 'subjects.id')
            ->where('package_id', $packageId)
            ->select('subjects.name', 'subjects.id as subject_id', 'subjects.icon_url', 'package_data.package_id as package_id')
            ->distinct()
            ->get();

        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',

        ])->first();

        $totalCountCount = $this->getDataCount($packageId, null, null, null);

        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'total_resouces' => $totalCountCount['total_count'],
            'video_count'    => $totalCountCount['video_count'],
            'pdf_count'      => $totalCountCount['pdf_count'],
            'mcq_count'      => $totalCountCount['mcq_count'],

            'data'           => $subjects,
        ], 200);
    }

    public function getDataCount($packageId, $subjectId = null, $topicId = null, $subtopicId = null, $subsubtopicId = null)
    {
        $query = PackageData::where('package_id', $packageId);

        if ($subtopicId !== null) {
            $query->where('sub_topic_id', $subtopicId);
        }

        if ($topicId !== null) {
            $query->where('topic_id', $topicId);
        }

        if ($subjectId !== null) {
            $query->where('subject_id', $subjectId);
        }
        if ($subsubtopicId !== null) {
            $query->where('sub_sub_topic_id', $subsubtopicId);
        }

        // Get the total count of all data
        $totalCount = $query->count();

        // Get counts for individual types
        $videoCount = (clone $query)->where('data_type', 'video')->count();
        $pdfCount   = (clone $query)->where('data_type', 'pdf')->count();
        $mcqCount   = (clone $query)->where('data_type', 'mcq')->count();

        return [
            'total_count' => $totalCount,
            'video_count' => $videoCount,
            'pdf_count'   => $pdfCount,
            'mcq_count'   => $mcqCount,
        ];
    }

// public function getDataCount($packageId, $subjectId = null, $topicId = null, $subtopicId = null, $subsubtopicId = null)
    // {
    //     // Normalize values
    //     $subjectId = $subjectId !== null && $subjectId !== 0 ? $subjectId : 'NA';
    //     $topicId = $topicId !== null && $topicId !== 0 ? $topicId : 'NA';
    //     $subtopicId = $subtopicId !== null && $subtopicId !== 0 ? $subtopicId : 'NA';
    //     $subsubtopicId = $subsubtopicId !== null && $subsubtopicId !== 0 ? $subsubtopicId : 'NA';

//     $query = PackageData::where('package_id', $packageId)
    //         ->where('subject_id', $subjectId)
    //         ->where('topic_id', $topicId)
    //         ->where('sub_topic_id', $subtopicId)
    //         ->where('sub_sub_topic_id', $subsubtopicId);

//     // Get the total count of all data
    //     $totalCount = $query->count();

//     // Get counts for individual types
    //     $videoCount = (clone $query)->where('data_type', 'video')->count();
    //     $pdfCount = (clone $query)->where('data_type', 'pdf')->count();
    //     $mcqCount = (clone $query)->where('data_type', 'mcq')->count();

//     return [
    //         'total_count' => $totalCount,
    //         'video_count' => $videoCount,
    //         'pdf_count' => $pdfCount,
    //         'mcq_count' => $mcqCount,
    //     ];
    // }

    public function topic($subjectId, $packageId)
    {

        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();

        $subjectDetails = Subjects::where('id', $subjectId)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        $subjects = PackageData::
            join('topics', 'package_data.topic_id', '=', 'topics.id')
            ->where('package_id', $packageId)
            ->where('package_data.subject_id', $subjectId)

            ->select('topics.name', 'topics.id as topic_id', 'topics.icon_url', 'topics.subject_id', 'package_data.package_id as package_id')
            ->distinct()
            ->get();

        foreach ($subjects as $subject) {
            $topic_id        = $subject->topic_id;
            $totalCountCount = $this->getDataCount($packageId, $subjectId, $topic_id, null, null);

            $subject['total_resouces'] = $totalCountCount['total_count'];
            $subject['video_count']    = $totalCountCount['video_count'];
            $subject['pdf_count']      = $totalCountCount['pdf_count'];
            $subject['mcq_count']      = $totalCountCount['mcq_count'];
        }

        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,
            'data'           => $subjects,

        ], 200);
    }

    public function subtopic($topicId, $subjectId, $packageId)
    {

        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();

        $subjectDetails = Subjects::where('id', $subjectId)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        $topicDetails = Topics::where('id', $topicId)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        $totalCountCount = $this->getDataCount($packageId, $subjectId, $topicId, null, null);

        $subjects = PackageData::
            join('sub_topics', 'package_data.sub_topic_id', '=', 'sub_topics.id')
            ->where('package_id', $packageId)
            ->where('package_data.subject_id', $subjectId)
            ->where('package_data.topic_id', $topicId)

            ->select('sub_topics.name', 'sub_topics.id as sub_topic_id', 'sub_topics.topic_id as topic_id', 'sub_topics.icon_url', 'sub_topics.subject_id', 'package_data.package_id as package_id')
            ->distinct()
            ->get();

        foreach ($subjects as $subject) {
            $topic_id         = $subject->topic_id;
            $sub_topic_id     = $subject->sub_topic_id;
            $totalCCountCount = $this->getDataCount($packageId, $subjectId, $topic_id, $sub_topic_id, null);

            $subject['total_resouces'] = $totalCCountCount['total_count'];
            $subject['video_count']    = $totalCCountCount['video_count'];
            $subject['pdf_count']      = $totalCCountCount['pdf_count'];
            $subject['mcq_count']      = $totalCCountCount['mcq_count'];
        }

        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,
            'topicdetails'   => $topicDetails,
            'total_resouces' => $totalCountCount['total_count'],
            'video_count'    => $totalCountCount['video_count'],
            'pdf_count'      => $totalCountCount['pdf_count'],
            'mcq_count'      => $totalCountCount['mcq_count'],
            'data'           => $subjects,
        ], 200);
    }

    public function subsubtopic($subtopicId, $topicId, $subjectId, $packageId)
    {
        $subjects = PackageData::
            join('sub_sub_topics', 'package_data.sub_sub_topic_id', '=', 'sub_sub_topics.id')
            ->where('package_id', $packageId)
            ->where('package_data.subject_id', $subjectId)
            ->where('package_data.topic_id', $topicId)

            ->select('sub_sub_topics.name', 'sub_sub_topics.sub_topic_id as sub_topic_id', 'sub_sub_topics.topic_id as topic_id', 'sub_sub_topics.id as sub_sub_topic_id', 'sub_sub_topics.icon_url', 'sub_sub_topics.subject_id', 'package_data.package_id as package_id')
            ->distinct()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'data'    => $subjects,
        ], 200);
    }

    // public function getContents($subsubtopicId, $subtopicId, $topicId, $subjectId, $packageId)
    // {
    //     // Handling '0' values by setting them to 'NA'
    //     if ($subsubtopicId == 0) {
    //         $subsubtopicId = 'NA';
    //     }
    //     if ($subtopicId == 0) {
    //         $subtopicId = 'NA';
    //     }

    //     // Fetching data based on the provided IDs
    //     $getData = PackageData::where('sub_topic_id', $subtopicId)
    //         ->where('topic_id', $topicId)
    //         ->where('subject_id', $subjectId)
    //         ->where('sub_sub_topic_id', $subsubtopicId)
    //         ->where('package_id', $packageId)
    //         ->get();

    //     // Initializing arrays to hold different types of content
    //     $video = [];
    //     $pdf = [];
    //     $mcq = [];

    //     // Iterating through fetched data to categorize and fetch additional details
    //     foreach ($getData as $value) {
    //         if ($value->data_type == 'pdf') {
    //             $pdfData = ReadableDocuments::find($value->data_id);
    //             if ($pdfData) {
    //                 // Creating an associative array to store PDF details
    //                 $mypdf = [
    //                     'id' => $value->data_id,
    //                     'file_url' => $pdfData->file_url,
    //                     'title' => $pdfData->title,
    //                     'data_type' => $value->data_type,
    //                     'number' => rand(1, 22)

    //                 ];
    //                 $pdf[] = $mypdf;
    //             }
    //         }

    //         if ($value->data_type == 'video') {
    //             $videoData = Videos::find($value->data_id);
    //             if ($videoData) {
    //                 // Creating an associative array to store video details
    //                 $myvideo = [
    //                     'id' => $value->data_id,
    //                     'file_url' => $videoData->video_url,
    //                     'title' => $videoData->title,
    //                     'data_type' => $value->data_type,
    //                     'number' => rand(1,28)

    //                 ];
    //                 $video[] = $myvideo;
    //             }
    //         }

    //         if ($value->data_type == 'mcq') {
    //             $mcqData = MCQs::where('batch_id', $value->data_id)->first();
    //             if ($mcqData) {
    //                 // Creating an associative array to store MCQ details
    //                 $mymcq = [
    //                     'id' => $value->data_id,
    //                     'title' => $mcqData->title,
    //                     'file_url' => $mcqData->batch_id, // This seems like it should be a different field
    //                     'data_type' => $value->data_type,
    //                     'number' => MCQs::where('batch_id', $mcqData->batch_id)->count()

    //                 ];
    //                 $mcq[] = $mymcq;
    //             }
    //         }
    //     }

    //     // Combining all categorized data into a single array
    //     $allData = [
    //         'pdf' => $pdf,
    //         'video' => $video,
    //         'mcq' => $mcq,
    //     ];

    //     $packageDetails = PackageDetails::where('id', $packageId)->get([
    //         'id',
    //         'package_name',
    //         'package_code',
    //         'package_price',
    //         'package_image',
    //     ])->first();

    //     $subjectDetails = Subjects::where('id', $subjectId)->get([
    //         'id',
    //         'name',
    //         'icon_url',
    //     ])->first();

    //     $topicDetails = Topics::where('id', $topicId)->get([
    //         'id',
    //         'name',
    //         'icon_url',
    //     ])->first();

    //     // Returning a JSON response with the fetched data
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Fetch Successfully',
    //         'packagedetails' => $packageDetails,
    //         'subjectdetails' => $subjectDetails,
    //         'topicdetails' => $topicDetails,
    //         'data' => $allData,
    //     ], 200);
    // }

    public function getContents($subsubtopicId, $subtopicId, $topicId, $subjectId, $packageId)
    {
        \Log::info("Package: $packageId | Subject ID: $subjectId | Topic ID: $topicId | Sub Topic ID: $subtopicId | Sub Sub Topic ID: $subsubtopicId");
        // Handling '0' values by setting them to 'NA'
        if ($subsubtopicId == 0) {
            $subsubtopicId = 'NA';
        }
        if ($subtopicId == 0) {
            $subtopicId = 'NA';
        }

        // Fetching data based on the provided IDs
        $getData = PackageData::where('sub_topic_id', $subtopicId)
            ->where('topic_id', $topicId)
            ->where('subject_id', $subjectId)
            ->where('sub_sub_topic_id', $subsubtopicId)
            ->where('package_id', $packageId)
            ->get();

        // Initializing arrays to hold different types of content
        $video = [];
        $pdf   = [];
        $mcq   = [];

        // Iterating through fetched data to categorize and fetch additional details
        foreach ($getData as $value) {
            if ($value->data_type == 'pdf') {
                $pdfData = ReadableDocuments::find($value->data_id);
                if ($pdfData) {
                    // Creating an associative array to store PDF details
                    $mypdf = [
                        'id'        => $value->data_id,
                        'file_url'  => $pdfData->file_url,
                        'title'     => $pdfData->title,
                        'data_type' => $value->data_type,
                        'number'    => rand(1, 22),

                    ];
                    $pdf[] = $mypdf;
                }
            }

            if ($value->data_type == 'video') {
                $videoData = Videos::find($value->data_id);
                if ($videoData) {
                    // Creating an associative array to store video details
                    $myvideo = [
                        'id'        => $value->data_id,
                        'file_url'  => $videoData->video_url,
                        'title'     => $videoData->title,
                        'data_type' => $value->data_type,
                        'number'    => rand(1, 28),

                    ];
                    $video[] = $myvideo;
                }
            }

            if ($value->data_type == 'mcq') {
                $mcqData = MCQs::where('batch_id', $value->data_id)->first();
                if ($mcqData) {
                    // Creating an associative array to store MCQ details
                    $mymcq = [
                        'id'        => $value->data_id,
                        'title'     => $mcqData->title,
                        'file_url'  => $mcqData->batch_id, // This seems like it should be a different field
                        'data_type' => $value->data_type,
                        'number'    => MCQs::where('batch_id', $mcqData->batch_id)->count(),

                    ];
                    $mcq[] = $mymcq;
                }
            }
        }

        // Combining all categorized data into a single array
        $allData = [
            'pdf'   => $pdf,
            'video' => $video,
            'mcq'   => $mcq,
        ];

        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();

        $subjectDetails = Subjects::where('id', $subjectId)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        $topicDetails = Topics::where('id', $topicId)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        // Returning a JSON response with the fetched data
        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetch Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,
            'topicdetails'   => $topicDetails,
            'data'           => $allData,
        ], 200);
    }

    public function mcqquestions($batchId)
    {
        $questions = MCQs::where('batch_id', $batchId)->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'data'    => $questions,
        ], 200);

    }

    public function savMCQDetails(Request $request)
    {
        \Log::info('Received MCQ details', ['data' => $request->all()]);

        $batchId      = $request->batchId;
        $correctAns   = is_numeric($request->correctans) ? (int) $request->correctans : 0;
        $totalans     = is_numeric($request->totalans) ? (int) $request->totalans : 1; // Default to 1 to prevent division by zero
        $timetaken    = is_numeric($request->timetaken) ? (int) $request->timetaken : 0;
        $maxTimeTaken = $totalans * 60; // 60 seconds per question

        $rank = 1;

        // Calculate accuracy
        if ($totalans != 0) {
            $accuracy   = ($correctAns / $totalans) * 100;
            $speedScore = 100 - (($timetaken / $maxTimeTaken) * 100);
        } else {
            $accuracy   = 0; // or handle this case as needed
            $speedScore = 0;
        }

        $speedScore = max(0, $speedScore); // Ensure no negative values

        // Calculate speed score

        // Calculate final score
        $finalScore = ($accuracy * 0.8) + ($speedScore * 0.2);

        // check if this is a duplicate submission
        $checkDuplicate = Usermcqresult::where('batchId', $batchId)
            ->where('userId', $request->userId)
            ->where('finalScore', $finalScore)
            ->where('correctAns', $correctAns)
            ->where('totalans', $totalans)
            ->where('timetaken', $request->timetaken)
            ->first();

        // Fetch all users for the batch, ordered by finalScore in descending order
        $calculateRank = Usermcqresult::where('batchId', $batchId)
            ->orderByDesc('finalScore')
            ->get();

        // Assign ranks
        $rank = 1;
        foreach ($calculateRank as $index => $user) {
            // Handle tied ranks
            if ($index > 0 && $calculateRank[$index]->finalScore == $calculateRank[$index - 1]->finalScore) {
                $user->rank = $calculateRank[$index - 1]->rank;
            } else {
                $user->rank = $rank;
            }
            $rank++;

            // Save the updated rank back to the database
            $user->save();
        }

        if ($checkDuplicate) {
            // Re-fetch updated rank from DB
            $latestRank = Usermcqresult::where('id', $checkDuplicate->id)->value('rank');

            return response()->json([
                'status'  => 'success',
                'message' => 'Fetched Successfully',
                'rank'    => (int) $latestRank,
                'id'      => $checkDuplicate->id,
            ], 200);
        } else {
            $mcqprac             = new Usermcqresult();
            $mcqprac->batchId    = $batchId;
            $mcqprac->userId     = $request->userId;
            $mcqprac->correctAns = $correctAns;
            $mcqprac->finalScore = $finalScore;
            $mcqprac->totalans   = $totalans;
            $mcqprac->timetaken  = $timetaken;
            $mcqprac->category   = 'practice';
            $mcqprac->rank       = $rank;
            $mcqprac->save();
        }

        $calculateRank = Usermcqresult::where('batchId', $batchId)
            ->orderByDesc('finalScore')
            ->get();

        // Assign ranks
        $rank = 1;
        foreach ($calculateRank as $index => $user) {
            // Handle tied ranks
            if ($index > 0 && $calculateRank[$index]->finalScore == $calculateRank[$index - 1]->finalScore) {
                $user->rank = $calculateRank[$index - 1]->rank;
            } else {
                $user->rank = $rank;
            }
            $rank++;

            // Save the updated rank back to the database
            $user->save();
        }

        if (isset($request->answers)) {

            $answered_questions = $request->answers;
            if (is_string($answered_questions)) {
                $answered_questions = json_decode($answered_questions, true);
            }

            if (is_array($answered_questions) || is_object($answered_questions)) {
                foreach ($answered_questions as $answer) {
                    MCQanswersbyuser::create([
                        'user_id'         => Auth::user()->id,
                        'batch_id'        => $batchId,
                        'attempt_id'      => $mcqprac->id,
                        'question_id'     => $answer['question_id'],
                        'selected_answer' => $answer['option'], // <-- updated here
                    ]);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid format for answers', 'data' => $request->answers], 400);
            }

        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'rank'    => (int) $user->rank,
            'id'      => $mcqprac->id,
        ], 200);

    }

    // public function savMCQDetails(Request $request)
    // {
    //     $batchId = $request->batchId;
    //     $finalScore = $request->finalscore;
    //     $correctAns = $request->correctans;
    //     $totalans = $request->totalans;
    //     $timetaken = $request->timetaken;

    //     $rank = '1';

    //     $mcqprac = new Usermcqresult();
    //     $mcqprac->batchId = $batchId;
    //     $mcqprac->userId = $request->userId;
    //     $mcqprac->correctAns = $correctAns;
    //     $mcqprac->finalScore = $finalScore;
    //     $mcqprac->totalans = $totalans;
    //     $mcqprac->timetaken = $timetaken;
    //     $mcqprac->category = 'practice';
    //     $mcqprac->rank = $rank;
    //     $mcqprac->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Fetched Successfully',
    //         'rank' => $rank,
    //         'id' => $mcqprac->id
    //     ], 200);

    // }

    public function getprofile()
    {
        $user          = Auth::user();
        $user->profile = UserProfile::where('userId', $user->id)->first();
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'data'    => $user,
        ], 200);
    }

    public function updateprofile(Request $request)
    {
        $user        = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->dob   = $request->dob;
        $user->save();

        $userProfile = UserProfile::where('userId', $user->id)->first();
        if ($userProfile) {
            $userProfile->fathersname  = $request->fathersname;
            $userProfile->fathersphone = $request->fathersphone;
            $userProfile->save();
        } else {
            $userProfile               = new UserProfile();
            $userProfile->userId       = $user->id;
            $userProfile->fathersname  = $request->fathersname;
            $userProfile->fathersphone = $request->fathersphone;
            $userProfile->save();
        }

        $user->profile = $userProfile;

        return response()->json([
            'status'  => 'success',
            'message' => 'Profile Updated Successfully',
            'data'    => $user,
        ], 200);
        // $user
    }

    public function checkUserandPackages(Request $request)
    {
        $packageId = intval($request->packageId);
        $user      = Auth::user();

        // Check purchased courses
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();

        // Check allocated courses
        $userBatches = StudentBatchToStudent::where('studentId', $user->id)->pluck('batchId')->toArray();

        // Initialize enrolled packages array
        $userEnrolledPackages = $userPackages;

        if (! empty($userBatches)) {
            $batchCourses         = StudentBatchToCourses::whereIn('batchId', $userBatches)->pluck('packageId')->toArray();
            $userEnrolledPackages = array_merge($userEnrolledPackages, $batchCourses);
        }

        // Remove duplicates and ensure IDs are integers
        $userEnrolledPackages = array_unique(array_map('intval', $userEnrolledPackages));
        // Check if user is enrolled in the requested package
        if (in_array($packageId, $userEnrolledPackages)) {
            return response()->json([
                'status'  => 'success',
                'message' => 'User enrolled in this course',
                'data'    => PackageDetails::where('id', $packageId)->first([
                    'id',
                    'package_name',
                    'package_code',
                    'package_status',
                    'package_price',
                    'package_image',
                ]),
            ], 200);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not enrolled in this course',
            ], 200);
        }
    }

    public function getEnrolledCourses()
    {
        $user = Auth::user();
        //check purchasedcourse
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();
        //checck allocatedcourses
        // Check the batches of the user
        $userBatches                      = StudentBatchToStudent::where('studentId', $user->id)->get();
        $checkcoursesallocatedtothatBatch = [];
        $userEnrolledPackages             = [];

        foreach ($userBatches as $batch) {
            $checkcoursesallocatedtothatBatch[] = StudentBatchToCourses::where('batchId', $batch->batchId)->pluck('packageId')->toArray();
        }

        for ($i = 0; $i < count($checkcoursesallocatedtothatBatch); $i++) {
            $userEnrolledPackages = array_merge($userPackages, $checkcoursesallocatedtothatBatch[$i]);
        }

        for ($i = 0; $i < count($userEnrolledPackages); $i++) {
            $userEnrolledPackages = array_unique($userEnrolledPackages);
        }
        // ÷now get all the courses from the packageDetails where package_id in userEnrolledPackages
        $enrolledPack = PackageDetails::whereIn('id', $userEnrolledPackages)->get([
            'id',
            'package_name',
            'package_code',
            'package_status',
            'package_price',
            'package_image',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => $enrolledPack,
        ], 200);
    }

    public function getVideoDetails(Request $request)
    {
        $videoId        = $request->videoId;
        $packageId      = $request->packageId;
        $videoDetails   = Videos::where('id', $videoId)->first();
        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();

        $subjectDetails = Subjects::where('id', $videoDetails->subject_id)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        $topicDetails = Topics::where('id', $videoDetails->topic_id)->get([
            'id',
            'name',
            'icon_url',
        ])->first();

        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectDetails' => $subjectDetails,
            'topicDetails'   => $topicDetails,
            'data'           => $videoDetails,
        ], 200);

    }

    public function packageDetails(Request $request)
    {

        $packageId      = $request->packageId;
        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();
        return response()->json([
            'status'  => 'success',
            'message' => 'Fetch Successfully',
            'data'    => $packageDetails,
        ], 200);
    }

    public function learnrecommendedpractice($packageId)
    {
        // Fetching data based on the provided IDs
        $getData = PackageData::where('package_id', $packageId)
            ->get();

        // Initializing arrays to hold different types of content
        $video = [];
        $pdf   = [];
        $mcq   = [];

        // Iterating through fetched data to categorize and fetch additional details
        foreach ($getData as $value) {
            if ($value->data_type == 'pdf') {
                $pdfData = ReadableDocuments::find($value->data_id);
                if ($pdfData) {
                    // Creating an associative array to store PDF details
                    $mypdf = [
                        'id'        => $value->data_id,
                        'file_url'  => $pdfData->file_url,
                        'title'     => $pdfData->title,
                        'data_type' => $value->data_type,

                    ];
                    $pdf[] = $mypdf;
                }
            }

            if ($value->data_type == 'video') {
                $videoData = Videos::find($value->data_id);
                if ($videoData) {
                    // Creating an associative array to store video details
                    $myvideo = [
                        'id'        => $value->data_id,
                        'file_url'  => $videoData->video_url,
                        'title'     => $videoData->title,
                        'data_type' => $value->data_type,
                    ];
                    $video[] = $myvideo;
                }
            }

            if ($value->data_type == 'mcq') {
                $mcqData = MCQs::where('batch_id', $value->data_id)->first();
                if ($mcqData) {
                    // Creating an associative array to store MCQ details
                    $mymcq = [
                        'id'        => $value->data_id,
                        'title'     => $mcqData->title,
                        'file_url'  => $mcqData->batch_id, // This seems like it should be a different field
                        'data_type' => $value->data_type,

                    ];
                    $mcq[] = $mymcq;
                }
            }
        }

        // Combining all categorized data into a single array
        $allData = [
            'pdf'         => $pdf,
            'video'       => $video,
            'recomenmded' => $video,
            'mcq'         => $mcq,
        ];

        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();

        // Returning a JSON response with the fetched data
        return response()->json([
            'status'         => 'success',
            'message'        => 'Fetch Successfully',
            'packagedetails' => $packageDetails,
            'data'           => $allData,
        ], 200);
    }

    public function updateprofileimage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = $user->id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/user_profile_pic/');
            $image->move($destinationPath, $name);
            $imagePath       = 'upload/user_profile_pic/' . $name;
            $user->photo_url = $imagePath;
            $user->save();

            // return json response
            // Returning a JSON response with the fetched data

            //   if file exists
            if (file_exists(public_path($user->photo_url))) {
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Photo Uploaded Successfully',
                    'data'    => [],
                ], 200);
            } else {
                return response()->json([
                    'status'  => 'fail',
                    'message' => 'Photo Upload Failed',
                    'data'    => [],
                ], 200);
            }
        } else {
            //return fail
            return response()->json([
                'status'  => 'fail',
                'message' => 'Photo Upload Failed',
                'data'    => [],
            ], 200);

        }
    }

    public function checkattemptedquizes()
    {
        $userId = Auth::user()->id;

        $getallatemptedquiz = Usermcqresult::where('userId', $userId)->get();

        foreach ($getallatemptedquiz as $quiz) {
            $quizdetails = MCQs::where('m_c_qs.batch_id', $quiz->batchId)
                ->join('subjects', 'm_c_qs.subject_id', 'subjects.id')
                ->join('topics', 'm_c_qs.topic_id', 'topics.id')
                ->get(['m_c_qs.id', 'title as quiz_title', 'topics.name as topic_name', 'subjects.name as subject_name', 'subjects.id as subject_id', 'topics.id as topic_id',
                ])
                ->first();
            $quiz->quizDetails = $quizdetails;

        }

        return response()->json([
            'status'  => 'success',
            'message' => 'All atempted Quizes',
            'data'    => $getallatemptedquiz,
        ], 200);

    }

    public function checkindividualattemptedquizes($id)
    {
        $userId = Auth::user()->id;

        $getallatemptedquiz = Usermcqresult::where('id', $id)->where('userId', $userId)->get();

        foreach ($getallatemptedquiz as $quiz) {
            $quizdetails = MCQs::where('m_c_qs.batch_id', $quiz->batchId)
                ->join('subjects', 'm_c_qs.subject_id', 'subjects.id')
                ->join('topics', 'm_c_qs.topic_id', 'topics.id')
                ->get(['m_c_qs.id', 'title as quiz_title', 'topics.name as topic_name', 'subjects.name as subject_name', 'subjects.id as subject_id', 'topics.id as topic_id',
                ])
                ->first();
            $quiz->quizDetails = $quizdetails;

        }

        return response()->json([
            'status'  => 'success',
            'message' => 'All atempted Quizes',
            'data'    => $getallatemptedquiz,
        ], 200);

    }

    public function getQuizAnalytics($id)
    {
        // Get specific user's result
        $userResult = Usermcqresult::where('id', $id)->firstOrFail();

        // Fetch all answers for this user's attempt
        $userAnswers = MCQanswersbyuser::where('attempt_id', $id)->get()->keyBy('question_id');

        // Fetch all quiz questions for the same batch
        $quizQuestions = MCQs::where('batch_id', $userResult->batchId)->get();

        // Attach selected answers to each question
        $questionsWithUserAnswer = $quizQuestions->map(function ($question) use ($userAnswers) {
            $question                            = $question->toArray();
            $question['answer_selected_by_user'] = isset($userAnswers[$question['id']])
            ? $userAnswers[$question['id']]->selected_answer
            : null;
            return $question;
        });

        // Calculate user stats
        $userCorrect    = (int) $userResult->correctAns;
        $userTotal      = (int) $userResult->totalans;
        $userPercentage = $userTotal > 0 ? round(($userCorrect / $userTotal) * 100, 2) : 0;
        $userAccuracy   = $userTotal > 0 ? round(($userCorrect / $userTotal) * 100, 2) : 0;
        $userTimeTaken  = $userResult->timetaken;

        // Get all batch results
        $batchResults = Usermcqresult::where('batchId', $userResult->batchId)->get();

        $totalPercentage = 0;
        $totalStudents   = 0;
        $percentileCount = 0;

        foreach ($batchResults as $result) {
            $correct = (int) $result->correctAns;
            $total   = (int) $result->totalans;

            if ($total > 0) {
                $percentage = ($correct / $total) * 100;
                $totalPercentage += $percentage;
                $totalStudents++;

                if ($percentage < $userPercentage) {
                    $percentileCount++;
                }
            }
        }

        // Final stats
        $averagePercentage = $totalStudents > 0 ? round($totalPercentage / $totalStudents, 2) : 0;
        $percentile        = $totalStudents > 1
        ? round(($percentileCount / ($totalStudents - 1)) * 100, 2)
        : 100;

        // Calculate user's rank within the batch (higher percentile = higher rank)
        $rank = $quizdetails = Usermcqresult::where('id', $id)->first()->rank;

                                                                                    // Calculate the user's total rank across all users (not limited to batch)
        $allResults = Usermcqresult::where('batchId', $userResult->batchId)->get(); // Get all quiz results for all users

        $totalRankCount = 0;
        $totalUsers     = 0;

        foreach ($allResults as $result) {
            $correct = (int) $result->correctAns;
            $total   = (int) $result->totalans;

            if ($total > 0) {
                $percentage = ($correct / $total) * 100;
                $totalUsers++;

                if ($percentage < $userPercentage) {
                    $totalRankCount++;
                }
            }
        }

        // Final total rank (higher totalRankCount = lower rank number)
        $totalRank = $totalUsers > 1 ? round(($totalRankCount / ($totalUsers - 1)) * $totalUsers) : 1;

        $userId             = Auth::user()->id;
        $getallatemptedquiz = Usermcqresult::where('id', $id)->where('userId', $userId)->get();
        foreach ($getallatemptedquiz as $quiz) {
            $quizdetails = MCQs::where('m_c_qs.batch_id', $quiz->batchId)
                ->join('subjects', 'm_c_qs.subject_id', 'subjects.id')
                ->join('topics', 'm_c_qs.topic_id', 'topics.id')
                ->get(['m_c_qs.id', 'title as quiz_title', 'topics.name as topic_name', 'subjects.name as subject_name', 'subjects.id as subject_id', 'topics.id as topic_id',
                ])
                ->first();
            $quiz->quizDetails = $quizdetails;
            $quiz->total_marks = $quizdetails = MCQs::where('m_c_qs.batch_id', $quiz->batchId)->count();

        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'data'    => [
                'quiz_analytics' => [
                    'user_percentage'    => $userPercentage,
                    'average_percentage' => $averagePercentage,
                    'percentile'         => $percentile,
                    'accuracy'           => $userAccuracy,
                    'time_taken'         => $userTimeTaken,
                    'rank'               => $rank,      // Rank within the batch
                    'total_rank'         => $totalRank, // Total rank across all users
                    'card_data'          => $getallatemptedquiz,
                ],
                'quiz_data'      => $questionsWithUserAnswer,
            ],
        ]);
    }

    public function getUserProfileAnalytics($userId)
    {
        $userResults = Usermcqresult::where('userId', $userId)->orderByDesc('created_at')->get();
        if ($userResults->isEmpty()) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'No quiz attempts found for this user.',
            ], 404);
        }

        $totalCorrect   = 0;
        $totalQuestions = 0;
        $totalTime      = 0;
        $totalRank      = 0;
        $rankCount      = 0;
        $percentileSum  = 0;
        $recentTests    = [];

        foreach ($userResults as $index => $userResult) {
            $correct = (int) $userResult->correctAns;
            $total   = (int) $userResult->totalans;
            $time    = (int) $userResult->timetaken;
            $rank    = (int) $userResult->rank;

            $totalCorrect += $correct;
            $totalQuestions += $total;
            $totalTime += $time;

            if ($rank > 0) {
                $totalRank += $rank;
                $rankCount++;
            }

            // Percentile calculation for this quiz
            $batchResults  = Usermcqresult::where('batchId', $userResult->batchId)->get();
            $higherScorers = 0;
            $totalStudents = 0;

            $quizdetails = MCQs::where('m_c_qs.batch_id', $userResult->batchId)
                ->join('subjects', 'm_c_qs.subject_id', 'subjects.id')
                ->join('topics', 'm_c_qs.topic_id', 'topics.id')
                ->get(['m_c_qs.id', 'title as quiz_title', 'topics.name as topic_name', 'subjects.name as subject_name', 'subjects.id as subject_id', 'topics.id as topic_id',
                ])
                ->first();

            if (isset($quizdetails)) {
                foreach ($batchResults as $result) {
                    $batchCorrect = (int) $result->correctAns;
                    $batchTotal   = (int) $result->totalans;

                    if ($batchTotal > 0) {
                        $batchPercent = ($batchCorrect / $batchTotal) * 100;
                        $userPercent  = $total > 0 ? ($correct / $total) * 100 : 0;

                        if ($batchPercent > $userPercent) {
                            $higherScorers++;
                        }

                        $totalStudents++;
                    }
                }

                // Fix percentile calculation
                if ($totalStudents > 1) {
                    $percentile = round((($totalStudents - $higherScorers - 1) / ($totalStudents - 1)) * 100, 2);
                } else {
                    $percentile = 100;
                }
                $percentileSum += $percentile;

                // Add recent 10 quizzes
                if (count($recentTests) < 10) {
                    $userPercentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                    $accuracy       = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

                    $recentTests[] = [
                        'test_name'  => $quizdetails->quiz_title ? $quizdetails->quiz_title : "No title",
                        'percentage' => $userPercentage,
                        'percentile' => $percentile,
                        'accuracy'   => $accuracy,
                        'correct'    => $correct,
                        'total'      => $total,
                        'test_date'  => $userResult->created_at->format('Y-m-d'),
                    ];
                }
            }
        }

        $totalTests         = $userResults->count();
        $accuracy           = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;
        $avgPercentile      = $totalTests > 0 ? round($percentileSum / $totalTests, 2) : 0;
        $avgRank            = $rankCount > 0 ? round($totalRank / $rankCount) : 'N/A';
        $avgTimePerQuestion = $totalQuestions > 0 ? round($totalTime / $totalQuestions) : 0;

        $incorrect = $totalQuestions - $totalCorrect;

        // Convert total test time
        $hours                  = floor($totalTime / 3600);
        $minutes                = floor(($totalTime % 3600) / 60);
        $seconds                = $totalTime % 60;
        $totalTestTimeFormatted = "{$hours}h {$minutes}m {$seconds}s";

        // Average time per question formatted
        $avgMin           = floor($avgTimePerQuestion / 60);
        $avgSec           = $avgTimePerQuestion % 60;
        $avgTimeFormatted = "{$avgMin}m {$avgSec}s";

        return response()->json([
            'status'  => 'success',
            'message' => 'Profile analytics generated successfully.',
            'data'    => [
                'average_accuracy'               => $accuracy,
                'total_correct_answers'          => $totalCorrect,
                'total_attempted_questions'      => $totalQuestions,
                'average_percentile'             => $avgPercentile,
                'students_scoring_more_than_you' => round(100 - $avgPercentile, 2),
                'average_rank'                   => $avgRank,
                'average_time_per_question'      => $avgTimeFormatted,
                'total_tests_attempted'          => $totalTests,
                'correct_incorrect_ratio'        => "$totalCorrect : $incorrect",
                'total_test_time'                => $totalTestTimeFormatted,
                'recent_tests'                   => $recentTests,
            ],
        ]);
    }

    public function saveStreak(Request $request)
    {
        $request->validate([
            'time' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        if (! $user) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Unauthorized',
            ], 401);
        }

        $today     = Carbon::today()->toDateString();
        $sessionId = $request->header('X-Session-Id') ?? Str::uuid(); // Optional: use custom session header or generate

        // Check if already exists for today + session
        $log = UserActivityLog::where('user_id', $user->id)
            ->where('session_id', $sessionId)
            ->where('activity_date', $today)
            ->first();

        if ($log) {
            $log->increment('time_spent', $request->time);
        } else {
            UserActivityLog::create([
                'user_id'       => $user->id,
                'session_id'    => $sessionId,
                'activity_date' => $today,
                'time_spent'    => $request->time,
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Activity logged successfully.',
        ]);
    }

    public function getStreak($id)
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found.',
            ], 404);
        }

        $logs = UserActivityLog::where('user_id', $id)
            ->orderBy('activity_date', 'asc')
            ->get();

        if ($logs->isEmpty()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'No activity found.',
                'data'    => [
                    'current_streak'            => 0,
                    'longest_streak'            => 0,
                    'total_active_days'         => 0,
                    'total_time_spent'          => '0h 0m 0s',
                    'current_month_time_spent'  => '0h 0m 0s',
                    'previous_month_time_spent' => '0h 0m 0s',
                ],
            ]);
        }

        $dates = $logs->pluck('activity_date')
            ->map(fn($date) => Carbon::parse($date)->toDateString())
            ->unique()
            ->values();

        $longestStreak = 1;
        $currentStreak = 1;
        $today         = Carbon::today()->toDateString();
        $yesterday     = Carbon::yesterday()->toDateString();

        for ($i = 1; $i < $dates->count(); $i++) {
            $prev    = Carbon::parse($dates[$i - 1]);
            $current = Carbon::parse($dates[$i]);

            if ($prev->copy()->addDay()->isSameDay($current)) {
                $currentStreak++;
            } else {
                $longestStreak = max($longestStreak, $currentStreak);
                $currentStreak = 1;
            }
        }

        $longestStreak = max($longestStreak, $currentStreak);

        $lastLog = Carbon::parse($dates->last());
        if (! $lastLog->isSameDay($today) && ! $lastLog->isSameDay($yesterday)) {
            $currentStreak = 0;
        }

        // Calculate total time spent
        $totalTimeInSeconds = $logs->sum('time_spent');
        $totalTimeSpent     = $this->formatTime($totalTimeInSeconds);

        // Calculate time spent this month
        $currentMonthLogs = $logs->filter(function ($log) {
            return Carbon::parse($log->activity_date)->isCurrentMonth();
        });
        $currentMonthTimeInSeconds = $currentMonthLogs->sum('time_spent');
        $currentMonthTimeSpent     = $this->formatTime($currentMonthTimeInSeconds);

        // Calculate time spent last month
        $previousMonthLogs = $logs->filter(function ($log) {
            return Carbon::parse($log->activity_date)->isLastMonth();
        });
        $previousMonthTimeInSeconds = $previousMonthLogs->sum('time_spent');
        $previousMonthTimeSpent     = $this->formatTime($previousMonthTimeInSeconds);

        return response()->json([
            'status'  => 'success',
            'message' => 'User streak data fetched.',
            'data'    => [
                'current_streak'            => $currentStreak,
                'longest_streak'            => $longestStreak,
                'total_active_days'         => $dates->count(),
                'total_time_spent'          => $totalTimeSpent,
                'current_month_time_spent'  => $currentMonthTimeSpent,
                'previous_month_time_spent' => $previousMonthTimeSpent,
            ],
        ]);
    }

    private function formatTime($totalTimeInSeconds)
    {
        $hours   = floor($totalTimeInSeconds / 3600);
        $minutes = floor(($totalTimeInSeconds % 3600) / 60);
        $seconds = $totalTimeInSeconds % 60;
        return "{$hours}h {$minutes}m {$seconds}s";
    }

    public function isAnythingChanged(Request $request)
    {
        $authUser        = Auth::user();
        $anythingChanged = 0;

        $currentChange = NewChanges::where('status', true)->get();
        if (count($currentChange) > 0) {
            foreach ($currentChange as $change) {
                $isChangesUpdatedByUser = ChangesUpdatedByUser::where('change_id', $change->id)->where('user_id', $authUser->id)->first();
                if (! $isChangesUpdatedByUser) {
                    $anythingChanged = 1;
                    break;
                    #keep the change id and send it to the frontend to show the changes to the user
                }
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched Successfully',
            'data'    => [
                'anything_changed' => $anythingChanged,
            ]]);
    }

    public function markChangeUpdated(Request $request)
    {
        $currentChange = NewChanges::where('status', true)->get();
        if (count($currentChange) > 0) {
            foreach ($currentChange as $change) {
                ChangesUpdatedByUser::create([
                    'change_id' => $change->id,
                    'user_id'   => Auth::user()->id,
                    'status'    => true,
                ]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Changes marked as updated successfully.',
        ]);
    }


    public function buyCourse(Request $request){
        $request->validate([
            'course_id' =>'required|integer',
            'payment_method' =>'required|string',
            'payment_id' =>'required|string',
            'amount' =>'required|numeric',
        ]);
    }

}
