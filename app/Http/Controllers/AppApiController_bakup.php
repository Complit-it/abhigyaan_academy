<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\MCQs;
use App\Models\PackageData;
use App\Models\PackageDetails;
use App\Models\ReadableDocuments;
use App\Models\StudentBatchToCourses;
use App\Models\StudentBatchToStudent;
use App\Models\Subjects;
use App\Models\Topics;
use App\Models\User;
use App\Models\Usermcqresult;
use App\Models\UserPackages;
use App\Models\UserProfile;
use App\Models\Videos;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Import the File facade
use Validator;

// Import the Storage facade

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
            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $user = User::where('phone', $request->phone_no)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not registered.',
            ], $status = 200, );
        }
        if (Hash::check($request->password, $user->password)) {
            $user->fcm_token = $request->fcm_token;
            $user->save();

            // $user->attachRole('customer');

            $token = $user->createToken('authToken')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully.',
                'token' => $token,
                'user' => $user,
            ], $status = 200, );
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials.',
            ], $status = 200, );
        }

    }

    public function appBanners()
    {
        $appBanners = Banners::where('category', 1)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'data' => $appBanners,
        ], 200);

    }

    public function enrolledCourses()
    {
        $courses = PackageDetails::where('package_status', 1)->get();
        // send as json
        // header('Content-Type: application/json');
        return response()->json([
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'data' => $courses,
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

        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'packagedetails' => $packageDetails,

            'data' => $subjects,
        ], 200);
    }

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

        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,

            'data' => $subjects,
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

        $subjects = PackageData::
            join('sub_topics', 'package_data.sub_topic_id', '=', 'sub_topics.id')
            ->where('package_id', $packageId)
            ->where('package_data.subject_id', $subjectId)
            ->where('package_data.topic_id', $topicId)

            ->select('sub_topics.name', 'sub_topics.id as sub_topic_id', 'sub_topics.topic_id as topic_id', 'sub_topics.icon_url', 'sub_topics.subject_id', 'package_data.package_id as package_id')
            ->distinct()
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,
            'topicdetails' => $topicDetails,
            'data' => $subjects,
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
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'data' => $subjects,
        ], 200);
    }

    public function getContents($subsubtopicId, $subtopicId, $topicId, $subjectId, $packageId)
    {
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
        $pdf = [];
        $mcq = [];

        // Iterating through fetched data to categorize and fetch additional details
        foreach ($getData as $value) {
            if ($value->data_type == 'pdf') {
                $pdfData = ReadableDocuments::find($value->data_id);
                if ($pdfData) {
                    // Creating an associative array to store PDF details
                    $mypdf = [
                        'id' => $value->data_id,
                        'file_url' => $pdfData->file_url,
                        'title' => $pdfData->title,
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
                        'id' => $value->data_id,
                        'file_url' => $videoData->video_url,
                        'title' => $videoData->title,
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
                        'id' => $value->data_id,
                        'title' => $mcqData->title,
                        'file_url' => $mcqData->batch_id, // This seems like it should be a different field
                        'data_type' => $value->data_type,

                    ];
                    $mcq[] = $mymcq;
                }
            }
        }

        // Combining all categorized data into a single array
        $allData = [
            'pdf' => $pdf,
            'video' => $video,
            'mcq' => $mcq,
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
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'packagedetails' => $packageDetails,
            'subjectdetails' => $subjectDetails,
            'topicdetails' => $topicDetails,
            'data' => $allData,
        ], 200);
    }

    public function mcqquestions($batchId)
    {
        $questions = MCQs::where('batch_id', $batchId)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'data' => $questions,
        ], 200);

    }

    public function savMCQDetails(Request $request)
    {
        $batchId = $request->batchId;
        $finalScore = $request->finalscore;
        $correctAns = $request->correctans;
        $totalans = $request->totalans;
        $timetaken = $request->timetaken;

        $rank = '1';

        $mcqprac = new Usermcqresult();
        $mcqprac->batchId = $batchId;
        $mcqprac->userId = $request->userId;
        $mcqprac->correctAns = $correctAns;
        $mcqprac->finalScore = $finalScore;
        $mcqprac->totalans = $totalans;
        $mcqprac->timetaken = $timetaken;
        $mcqprac->category = 'practice';
        $mcqprac->rank = $rank;
        $mcqprac->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'rank' => $rank,
        ], 200);

    }

    public function getprofile()
    {
        $user = Auth::user();
        $user->profile = UserProfile::where('userId', $user->id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'data' => $user,
        ], 200);
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->save();

        $userProfile = UserProfile::where('userId', $user->id)->first();
        if ($userProfile) {
            $userProfile->fathersname = $request->fathersname;
            $userProfile->fathersphone = $request->fathersphone;
            $userProfile->save();
        } else {
            $userProfile = new UserProfile();
            $userProfile->userId = $user->id;
            $userProfile->fathersname = $request->fathersname;
            $userProfile->fathersphone = $request->fathersphone;
            $userProfile->save();
        }

        $user->profile = $userProfile;

        return response()->json([
            'status' => 'success',
            'message' => 'Profile Updated Successfully',
            'data' => $user,
        ], 200);
        // $user
    }

    public function checkUserandPackages(Request $request)
    {
        $packageId = $request->packageId;

        $user = Auth::user();
        //check purchasedcourse
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();
        //checck allocatedcourses
        // Check the batches of the user
        $userBatches = StudentBatchToStudent::where('studentId', $user->id)->get();
        $checkcoursesallocatedtothatBatch = [];
        $userEnrolledPackages = []; 


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
            return response()->json([
                'status' => 'success',
                'message' => 'User enrolled in this course',
                'data' => PackageDetails::where('id', $packageId)->get([
                    'id',
                    'package_name',
                    'package_code',
                    'package_status',
                    'package_price',
                    'package_image',
                ])->first(),

            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not enrolled in this course',
            ], 200);
        }

    }

    public function checkUserPack($packageId)
    {
        $user = Auth::user();
        //check purchasedcourse
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();
        //checck allocatedcourses
        // Check the batches of the user
        $userBatches = StudentBatchToStudent::where('studentId', $user->id)->get();
        $checkcoursesallocatedtothatBatch = [];
        $userEnrolledPackages = []; 

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

    public function getEnrolledCourses()
    {
        $user = Auth::user();
        //check purchasedcourse
        $userPackages = UserPackages::where('user_id', $user->id)->pluck('package_id')->toArray();
        //checck allocatedcourses
        // Check the batches of the user
        $userBatches = StudentBatchToStudent::where('studentId', $user->id)->get();

        // echo $user;
        // die;
     
        $checkcoursesallocatedtothatBatch = [];
        $userEnrolledPackages = []; 


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

        if ($enrolledPack->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not enrolled in any course',
            ], 200);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'data' => $enrolledPack,
        ], 200);
    }

    public function getVideoDetails(Request $request)
    {
        $videoId = $request->videoId;
        $packageId = $request->packageId;
        $videoDetails = Videos::where('id', $videoId)->first();
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
            'status' => 'success',
            'message' => 'Fetched Successfully',
            'packagedetails' => $packageDetails,
            'subjectDetails' => $subjectDetails,
            'topicDetails' => $topicDetails,
            'data' => $videoDetails,
        ], 200);

    }

    public function packageDetails(Request $request)
    {

        $packageId = $request->packageId;
        $packageDetails = PackageDetails::where('id', $packageId)->get([
            'id',
            'package_name',
            'package_code',
            'package_price',
            'package_image',
        ])->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'data' => $packageDetails,
        ], 200);
    }

    public function getpdf(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'pdfId' => 'required',
            'packageId' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $packageId = $request->packageId;

        if (!$this->checkUserPack($packageId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not enrolled in this course',
            ], 200);
        }

        $pdfId = $request->pdfId;
        $pdfDetails = ReadableDocuments::where('id', $pdfId)->first();

        if (!$pdfDetails) {
            return response()->json([
                'status' => 'error',
                'message' => 'Document not found',
            ], 404);
        }

        // Get the file path from the PDF details
        $filePath = public_path($pdfDetails->file_url);

        // Check if the file exists in the public directory
        if (!File::exists($filePath)) {
            return response()->json([
                'status' => 'error',
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
            'status' => 'success',
            'message' => 'Fetch Successfully',
            'data' => [
                'pdfDetails' => $pdfDetails,
                'base64File' => $base64File,
            ],
        ], 200);
    }

}
