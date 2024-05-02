<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Job;
use App\Models\Options;
use App\Models\OptionsProvidedbyUser;
use App\Models\OTPVerification;
use App\Models\ProblemQuestions;
use App\Models\RSABookings;
use App\Models\RSARequest;
use App\Models\RSAResponseforJob;
use App\Models\User;
use App\Models\UserVehicleOwnerData;
use App\Models\UserVehicles;
use App\Models\VehicleBrand;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\Worker;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CustomerApiController extends Controller
{
    //

    public function getnotsupported()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Get Method Not Supported',
        ], $status = 500, );
    }

    public function otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|digits:12',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 500);
        }
        $numbers = array((int) $request->phone_no);
        $sender = urlencode('CMPLIT');
        $otp = rand(100000, 999999);
        // insertOTP
        $otpVerification = OTPVerification::where('phone_no', $request->phone_no)->first();

        //check for test phone

        if (in_array($request->phone_no, TestPhone::testPhone())) {
            $otp = 123456;

            if ($otpVerification) {
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();
            } else {

                $addOTP = OTPVerification::updateOrCreate([
                    'phone_no' => $request->phone_no,
                    'otp' => SHA1($otp),
                    'valid_upto' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                    'status' => 0,
                ]);
            }

        } else {
            if ($otpVerification) {
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();
            } else {

                $addOTP = OTPVerification::updateOrCreate([
                    'phone_no' => $request->phone_no,
                    'otp' => SHA1($otp),
                    'valid_upto' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                    'status' => 0,
                ]);
            }

            $message = 'Your OTP for logging into Roadpartner is ' . $otp . '. Please do not share your OTP with anyone.';
            $numbers = implode(',', $numbers);
            $apiKey = 'NjY1MjM3MzI0NDc4NDk0ZjMzNDE2MzU2NmI2ODZiNDU=';
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        }

        return response()->json(['status' => 'success',
            'message' => 'OTP sent Successfully',
        ], $status = 201);
    }

    public function checkOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|digits:12',
            'otp' => 'required|digits:6',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }
        $phone_no = $request->phone_no;
        $otp = $request->otp;

        //Check OTP
        $checkifOTPPresent = OTPVerification::where('phone_no', $phone_no)
            ->where('valid_upto', '>', NOW())
            ->where('status', '0')->first();

        if (!$checkifOTPPresent) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP is expired.',
            ], $status = 200, );
        }

        if ($checkifOTPPresent->otp != SHA1($otp)) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP is invalid.',
            ], $status = 200, );
        }

        if ($checkifOTPPresent->otp == SHA1($otp)) {
            $checkifOTPPresent->status = 1;
            $checkifOTPPresent->save();

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully.',
            ], $status = 200, );
        }
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'name' => 'required',
            'phone_no' => 'required|digits:12',
            'email' => 'required|email',
            'password' => 'required',
            'device_id' => 'required',
            'device_type' => 'required',
            'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $checkifUserPresent = User::where('phone', $request->phone_no)->first();
        if ($checkifUserPresent) {
            return response()->json([
                'status' => 'error',
                'message' => 'User already registered.',
            ], $status = 200, );
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'device_id' => $request->device_id,
            'device_type' => $request->device_type,
            'fcm_token' => $request->fcm_token,
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully.',
            'token' => $token,
            'user' => $user,
        ], $status = 200, );

    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'phone_no' => 'required|digits:12',
            'password' => 'required',
            "fcm_token" => "required",
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

            $user->attachRole('customer');

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

    public function loginwithOTP(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'phone_no' => 'required|digits:12',
            'otp' => 'required|digits:6',
            "fcm_token" => "required",
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
            //create a user
            $user = User::create([
                'name' => '',
                'email' => $request->phone_no,
                'phone' => $request->phone_no,
                'photo_url' => '',
                'phone_otp' => '',
                'email_otp' => '',
                'fcm_token' => $request->fcm_token,
                'password' => Hash::make($request->phone_no),

            ]);
            $user->attachRole('customer');

        }

        //Check OTP
        $checkifOTPPresent = OTPVerification::where('phone_no', $request->phone_no)
            ->where('valid_upto', '>', NOW())
            ->where('status', '0')->first();

        if (!$checkifOTPPresent) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP is expired.',
            ], $status = 200, );
        }

        if (SHA1($request->otp) == $checkifOTPPresent->otp) {

            $checkifOTPPresent->status = 1;
            $checkifOTPPresent->save();

            $user->fcm_token = $request->fcm_token;
            $user->save();

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

    public function getBannersforHome()
    {
        $banners = Banners::where('status', 1)
            ->where('scheduledfrom', '<', NOW())
            ->where('scheduledto', '>', NOW())
            ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Banners fetched successfully.',
            'banners' => $banners,
        ], $status = 200, );
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'email' => 'required',
            'phone_no' => 'required|digits:12',
            'dob' => 'required',
            'gender' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $user = User::find(Auth::user()->id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], $status = 200, );
        }
        //check for duplicate phone
        $existinguser = User::where('phone', $request->phone)
            ->where('id', '<>', Auth::user()->id)->first();

        if ($existinguser && $existinguser->id != $request->userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Phone number already registered.',
            ], $status = 200, );
        }

        $user->email = $request->email;
        $user->phone = $request->phone_no;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->name = $request->name;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User profile updated successfully.',
            'user' => $user,
        ], $status = 200, );

    }

    public function getUserProfile(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], $status = 200, );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User profile fetched successfully.',
            'user' => $user,
        ], $status = 200, );
    }

    public function getModelsbyBrand(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'brand_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $brand = $request->brand_id;

        // //Get Id of the brand
        $brandId = VehicleBrand::where('id', $brand)->first();
        // $vehicleModels = VehicleModel::whereIn('vehicleCategoryId_fk', function ($query) {
        //     $query->select('id')->from('vehicle_categories')->where('vehicleBrandId_fk', '=', 1);
        // })->get();

        $categoryIdArray = VehicleCategory::where('vehicleBrandId_fk', $brand)->pluck('id');
        $vehicleModels = VehicleModel::whereIn('vehicleCategoryId_fk', $categoryIdArray)->get();

        // $jobs = ServiceSubCategory::where('serviceId_fk', $service->id)->pluck('name')->toArray();

        foreach ($vehicleModels as $key) {
            $getcategory = VehicleCategory::where('id', $key->vehicleCategoryId_fk)->first();
            $key["category_id"] = $getcategory->id;
            $key["category_name"] = $getcategory->name;
            $key["brand_id"] = $brandId->id;
            $key["brand_name"] = $brandId->name;

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle Models fetched successfully.',
            'models' => $vehicleModels,
        ], 200);
    }

    public function adduserVehicle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            // 'category_id' => 'required',
            'model_id' => 'required',
            'vehicle_no' => 'required',
            // 'vehicle_color' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                'status' => 'error',
                'message' => $messages,
            ], 200);
        }

        // $user = User::find($request->user_id);
        // if (!$user) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'User not found.',
        //     ], $status = 200, );
        // }

        $rcImage = "";

        if ($request->hasFile('rc_image')) {
            //delete previous images
            // $this->deleteExistingFile($previousData->imageUrl);
            $newImage1 = "images/rc_images/" . $request->vehicle_no . "_" . time() . "." . $request->rc_image->extension();
            $path = $request->rc_image->move(public_path('images/rc_images'), $newImage1);
            $rcImage = urlencode($newImage1);
        }

        $vehicleImage = "";
        if ($request->hasFile('vehicle_image')) {
            //delete previous images
            // $this->deleteExistingFile($previousData->imageUrl);
            $newImage = "images/vehicle_image/" . $request->vehicle_no . "_" . time() . "." . $request->vehicle_image->extension();
            $path = $request->vehicle_image->move(public_path('images/vehicle_image'), $newImage);
            $vehicleImage = urlencode($newImage);
        }

        //also add as user

        $getcar = UserVehicles::where('vehicle_number', $request->vehicle_no)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$getcar) {

            $categoryId = VehicleModel::where('id', $request->model_id)->first()->vehicleCategoryId_fk;

            $vehicle = new UserVehicles();
            $vehicle->user_id = Auth::user()->id;
            $vehicle->vehicle_brand_id = $request->brand_id;
            $vehicle->vehicle_model_id = $request->model_id;
            $vehicle->vehicle_number = $request->vehicle_no;
            $vehicle->vehicle_color = $request->vehicle_color;
            $vehicle->vehicle_image = $vehicleImage;
            $vehicle->vehicle_rc_image = $rcImage;
            $vehicle->vehicle_category_id = $categoryId;
            $vehicle->save();

            $addVehicleOwner = new UserVehicleOwnerData();
            $addVehicleOwner->user_id = Auth::user()->id;
            $addVehicleOwner->vehicle_id = $vehicle->id;
            $addVehicleOwner->vehicle_number = $request->vehicle_no;
            $addVehicleOwner->owner_id = Auth::user()->id;
            $addVehicleOwner->save();

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle already added.',

            ], $status = 200, );
        }

        //also add as user

        $getcarasuser = User::where('phone', $request->vehicle_no)->first();
        if (!$getcarasuser) {
            $newUser = new User();
            $newUser->phone = $request->vehicle_no;
            $newUser->password = Hash::make("Password@123");
            $newUser->name = $request->vehicle_no;
            $newUser->email = $request->vehicle_no . "@na.com";
            $newUser->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle added successfully.',
        ], $status = 200, );

    }

    public function getquestions(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'vehicle_id' => 'required',
            'problem_category' => 'required',
            'job_id' => 'nullable',
            'option_id' => 'nullable',
            'question_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        //create a joib id if not exists

        if ($request->job_id != "" || $request->job_id != null) {
            $job_id = $request->job_id;

        } else {
            //create a job
            // create a 7 digit random alphanumeric number and check if it exists in the database
            $job_id = $this->generateRandomString(7);
            $checkifJobPresent = Job::where('job_id', $job_id)->first();
            while ($checkifJobPresent) {
                $checkifJobPresent = Job::where('job_id', $job_id)->first();
            }
            $job = new Job();
            $job->job_id = $job_id;
            $job->user_id = Auth::user()->id;
            $job->vehicle_id = $request->vehicle_id;
            $job->save();
        }

        //created a joib id if not exists end

        $getVehicleDetails = UserVehicles::where('id', $request->vehicle_id)->first();
        $getQuestionsCategory = Options::where('service_category_id', $request->problem_category)
            ->get(['question_id']);

        //if it is the 1st question
        if (($request->option_id == "" || $request->option_id == null) && ($request->question_id == "" || $request->question_id == null)) {

            $priority = 1;
            $question_id = 0;

            $getQuestions = ProblemQuestions::where('brandId', $getVehicleDetails->vehicle_brand_id)
                ->where('modelId', $getVehicleDetails->vehicle_model_id)
                ->where('categoryId', $getVehicleDetails->vehicle_category_id)
                ->where('priority', '>=', $priority)
                ->where('id', '<>', $question_id)
                ->whereIn('id', $getQuestionsCategory->pluck('question_id')->toArray())
                ->orderBy('priority', 'asc')
                ->first();

            if ($getQuestions) {
                $optionsfortheQuetsion = Options::where('question_id', $getQuestions->id)->get();
            } else {
                $optionsfortheQuetsion = null;
            }

            $message = 'Job created successfully.';
        } else {
            // for 2nd question and following questions
            //save the responseprovided by user
            $optionsProvided = new OptionsProvidedbyUser();
            $optionsProvided->user_id = Auth::user()->id;
            $optionsProvided->job_id = $job_id;
            $optionsProvided->vehicle_id = $request->vehicle_id;
            $optionsProvided->question_id = $request->question_id;
            $optionsProvided->option_id = $request->option_id;
            $optionsProvided->text_answer = $request->text_answer;
            $optionsProvided->image_answer = $request->image_answer;
            $optionsProvided->save();
            // $checkfor the questions already answered
            $answeredQuestions = OptionsProvidedbyUser::where('job_id', $job_id)->pluck('question_id')->toArray();
            $lastAnsweredQuestion = OptionsProvidedbyUser::where('job_id', $job_id)
                ->latest('id')
                ->first();
            $getLastQuestionDetails = ProblemQuestions::where('id', $request->question_id)->first();

            $getQuestions = ProblemQuestions::where('brandId', $getVehicleDetails->vehicle_brand_id)
                ->where('modelId', $getVehicleDetails->vehicle_model_id)
                ->where('categoryId', $getVehicleDetails->vehicle_category_id)
                ->where('priority', '>=', $getLastQuestionDetails->priority)
                ->whereNotIn('id', $answeredQuestions)
                ->whereIn('id', $getQuestionsCategory->pluck('question_id')->toArray())
                ->orderBy('priority', 'asc')
                ->first();

            if ($getQuestions) {
                $optionsfortheQuetsion = Options::where('question_id', $getQuestions->id)->get();
            } else {
                $optionsfortheQuetsion = null;
            }
            $message = 'New question feteched successfully.';

        }

        $jobdetails = Job::where('job_id', $job_id)->first();
        return response()->json(array([
            'status' => 'success',
            'message' => $message,
            'job_details' => $jobdetails,
            'questions' => $getQuestions,
            'options' => $optionsfortheQuetsion,
        ]), $status = 200, );

    }

    public function generateRandomString($num)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $num; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return strtoupper($randomString);
    }

    public function getMoreRSA(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'lat' => 'required',
            'long' => 'required',
            'radius' => 'required',
            'job_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $lat = $request->lat;
        $long = $request->long;
        $radius = $request->radius;

        RSARequest::create([
            'job_id' => $request->job_id,
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'status' => '0',
            'current_radius' => $request->radius,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Request for RSA scheduled successfully.',
            'data' => null,
        ], $status = 200, );
    }

    public function requestRSAforJob(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'job_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
                'data' => null,
            )], 200);
        }

        //send Request To 1
        $checkforFirst = RSAResponseforJob::where('job_id', $request->job_id)->first();

        $radius = RSARequest::where('job_id', $request->job_id)->first()->current_radius;
        if (!$checkforFirst) {
            $getRSA = DB::table('workers')
                ->where('preliminaryService', '0')
                ->select(
                    'id',
                    'name',
                    'phone_no',
                    'address',
                    'area',
                    'lat',
                    'long',
                    'fcm_token'
                )
                ->limit($radius)
                ->get();

            //sendCall to 1st User
            $this->sendCallforRSA($getRSA[0], $request->job_id);
        } else {
            // checkforTIme 2 minutes
            $checkTime = RSAResponseforJob::where('job_id', $request->job_id)
                ->where('created_at', '>', now()->subMinutes(2))
                ->first();

            $checkforAccepted = RSAResponseforJob::where('job_id', $request->job_id)
                ->where('response', 2)
                ->first();

            if ($checkTime && !$checkforAccepted) {
                return response()->json([array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => "RSA already requested for this job.",
                    'data' => null,

                )], 200);
            } else if ($checkforAccepted) {
                return response()->json([array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => "RSA already accepted for this job.",
                    'data' => "null", // to be edited
                )], 200);
            } else {
                $getRSA = DB::table('workers')
                    ->where('preliminaryService', '0')
                    ->whereNotIn('id', RSAResponseforJob::where('job_id', $request->job_id)->pluck('rsa_id')->toArray())
                    ->select(
                        'id',
                        'name',
                        'phone_no',
                        'address',
                        'area',
                        'lat',
                        'long',
                        'fcm_token'

                    )
                    ->limit($radius)
                    ->get();

                // if not found in the list increase the radius
                while ($getRSA == null && $radius < 25) {
                    $radius = $radius + 5;
                    $getRSA = DB::table('workers')
                        ->where('preliminaryService', '0')
                        ->whereNotIn('id', RSAResponseforJob::where('job_id', $request->job_id)->pluck('rsa_id')->toArray())

                        ->select(
                            'id',
                            'name',
                            'phone_no',
                            'address',
                            'area',
                            'lat',
                            'long',
                            'fcm_token'
                        )
                        ->limit($radius)
                        ->get();
                }

                $this->sendCallforRSA($getRSA[0], $request->job_id);
            }

        }

        return response()->json([array(
            'code' => 200,
            'status' => 'success',
            'data' => null,
        )], 200);

    }

    public function sendCallforRSA($rsa, $job_id)
    {

        // print_r($rsa);
        // die;

        $tokens = array();
        // foreach ($allUsers as $key => $value) {
        array_push($tokens, $rsa->fcm_token);
        // }
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'key=AAAARilr3uk:APA91bHUrPmGkIE_CctexWu2qrhIu4DH-Hm45g5FBIBNQOn239MU4NJ_2OvaEzMAz154trtnQDGROiMp7MkZwAQJsAUYAb3548_knDcspRfUyj9r41K69TsOi44NxYX06tHBMxqkZG3o',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => 'New RSA Request',
                'body' => 'New RSA Request Arrived. Check your app for more details.',
                'mutable_content' => true,
                'sound' => 'Tri-tone',
            ],
            'data' => [
                'url' => '<url of media image>',
                'dl' => '<deeplink action on tap of notification>',
            ],
        ]);

        if ($response->ok()) {
            $result = $response->json();
            // handle successful response

            //set the status of the RSA
            $rsaResponse = new RSAResponseforJob();
            $rsaResponse->job_id = $job_id;
            $rsaResponse->rsa_id = $rsa->id;
            $rsaResponse->response = 1; //1 for Pending
            $rsaResponse->save();
            return "success";

        } else {
            $error = $response->throw()->getMessage();
            // handle error
            return "error";
        }

    }

    public function getMoreRSA_working(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'lat' => 'required',
            'long' => 'required',
            'radius' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $lat = $request->lat;
        $long = $request->long;
        $radius = $request->radius;

        $getRSA = DB::table('workers')
            ->where('preliminaryService', '1')
            ->where('is_active', '1')
            ->select(
                'id',
                'name',
                'phone_no',
                'address',
                'area',
                'lat',
                'long',
                DB::raw('(6371 * acos(cos(radians(' . $lat . ')) * cos(radians(`lat`)) * cos(radians(`long`) - radians(' . $long . ')) + sin(radians(' . $lat . ')) * sin(radians(`lat`)))) AS distance')
            )
            ->having('distance', '<', $radius)
            ->get();

        while ($getRSA == null) {
            $radius = $radius + 5;
            $getRSA = DB::table('workers')
                ->where('preliminaryService', '1')
                ->where('is_active', '1')
                ->select(
                    'id',
                    'name',
                    'phone_no',
                    'address',
                    'area',
                    'lat',
                    'long',
                    DB::raw('(6371 * acos(cos(radians(' . $lat . ')) * cos(radians(`lat`)) * cos(radians(`long`) - radians(' . $long . ')) + sin(radians(' . $lat . ')) * sin(radians(`lat`)))) AS distance')
                )
                ->having('distance', '<', $radius)
                ->get();

        }

        return response()->json($getRSA);
    }

    // get List by Category
    public function getUserServiceByCategory(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $serviceName = $request->service_name;
        $getServiceperson = DB::table('workers')
            ->where('job', 'LIKE', '%' . $serviceName . '%')
            ->select(
                'name',
                'phone_no',
                'address',
                'area',
                'lat',
                'long',
                'job',
                'servics',
            )
            ->get();

        return response()->json($getServiceperson);
    }

    public function getApprovalFromRsa(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'job_id' => 'required',
            'rsa_phone' => 'required',
            'rsa_name' => 'required',
            'rsa_address' => 'required',
            'rsa_area' => 'required',
            'rsa_lat' => 'required',
            'rsa_long' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $job_id = $request->job_id;
        $rsa_phone = $request->rsa_phone;
        $rsa_name = $request->rsa_name;
        $rsa_address = $request->rsa_address;
        $rsa_area = $request->rsa_area;
        $rsa_lat = $request->rsa_lat;
        $rsa_long = $request->rsa_long;

        $job = Job::where('job_id', $job_id)->first();
        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found.',
            ], $status = 200, );
        }

        $job->rsa_phone = $rsa_phone;
        $job->rsa_name = $rsa_name;
        $job->rsa_address = $rsa_address;
        $job->rsa_area = $rsa_area;
        $job->rsa_lat = $rsa_lat;
        $job->rsa_long = $rsa_long;
        $job->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Job updated successfully.',
        ], $status = 200, );
    }

    public function bookrsa(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'job_id' => 'required',
            'rsa_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'code' => 200,
                'status' => 'error',
                'message' => $messages,
            )], 200);
        }

        $job_id = $request->job_id;
        $rsa_id = $request->rsa_id;

        $getJob = Job::where('job_id', $job_id)->first();

        $insertRSABooking = RSABookings::updateOrCreate([
            'job_id' => $job_id,
            'worker_id' => $rsa_id,
            'customer_id' => Auth::user()->id,
            'vehicle_id' => $getJob->vehicle_id,
            'work_status' => 'Initiated',
            'ispaid' => 0,
        ]);

        $allUsers = worker::where('id', $rsa_id)->select('fcm_token')->first();

        // echo $allUsers->fcm_token;
        // die;

        $this->notifytoNotification($allUsers->fcm_token, $job_id);

        return response()->json([
            'status' => 'success',
            'message' => 'RSA Requested successfully.',
        ], $status = 200, );

    }

    private function notifytoNotification($fcmToken, $jobId)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'key=AAAARilr3uk:APA91bHUrPmGkIE_CctexWu2qrhIu4DH-Hm45g5FBIBNQOn239MU4NJ_2OvaEzMAz154trtnQDGROiMp7MkZwAQJsAUYAb3548_knDcspRfUyj9r41K69TsOi44NxYX06tHBMxqkZG3o',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'registration_ids' => array($fcmToken),
            'notification' => [
                'title' => 'New RSA Booking Request',
                'body' => 'You have a new Booking request for Job Id ' . $jobId . '. Please check your App for more details.',
                'mutable_content' => true,
                'sound' => 'Tri-tone',
            ],
            'data' => [
                'url' => '<url of media image>',
                'dl' => '<deeplink action on tap of notification>',
            ],
        ]);

        if ($response->ok()) {
            $result = $response->json();
            // handle successful response
        } else {
            $error = $response->throw()->getMessage();
            // handle error
        }

    }

    public function getUserVehicles()
    {

        // echo "df";
        $userVehicles = UserVehicles::where('user_id', Auth::user()->id)->get();

        foreach ($userVehicles as $vehicleData) {
            $vehicleData->brand_name = VehicleBrand::where('id', $vehicleData->vehicle_brand_id)->first()->name;
            $vehicleData->model_name = VehicleModel::where('id', $vehicleData->vehicle_model_id)->first()->name;
            $vehicleData->category_name = VehicleCategory::where('id', $vehicleData->vehicle_category_id)->first()->name;
            $vehicleData->brand_image = VehicleBrand::where('id', $vehicleData->vehicle_brand_id)->first()->image;

        }

        return response()->json([
            'status' => 'success',
            'message' => 'User Vehicles fetched successfully.',
            'userVehicles' => $userVehicles,
        ], $status = 200, );
        // die;

        // foreach ($userVehicles as $vehicleData) {
        //     $vehicleData->brand_name = VehicleBrand::where('id', $vehicleData->vehicle_brand_id)->first()->name;
        //     $vehicleData->model_name = VehicleModel::where('id', $vehicleData->vehicle_model_id)->first()->name;
        //     $vehicleData->category_name = VehicleCategory::where('id', $vehicleData->vehicle_category_id)->first()->name;
        //     $vehicleData->vehicleImage = VehicleBrands::where('id', $vehicleData->vehicle_brand_id)->first()->image;

        // }

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User Vehicles fetched successfully.',
        //     'userVehicles' => $userVehicles,
        // ], $status = 200, );
    }

    public function getCustomerBrand()
    {
        $brands = VehicleBrand::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Brands fetched successfully.',
            'brands' => $brands,
        ], $status = 200, );
    }

    public function vehiclelogindetails(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                'status' => 'error',
                'message' => $messages,
            ], 200);
        }

        $getUserVehicle = UserVehicles::where('id', $request->id)->first();

        $getUserVehicle->categoryName = VehicleCategory::where('id', $getUserVehicle->vehicle_category_id)->first()->name;
        $getUserVehicle->brandName = VehicleBrand::where('id', $getUserVehicle->vehicle_brand_id)->first()->name;
        $getUserVehicle->modelName = VehicleModel::where('id', $getUserVehicle->vehicle_model_id)->first()->name;
        $getUserVehicle->modelyear = VehicleModel::where('id', $getUserVehicle->vehicle_model_id)->first()->year;
        $getUserVehicle->brand_image = VehicleBrand::where('id', $getUserVehicle->vehicle_brand_id)->first()->image;

        if (!$getUserVehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not registered.',
            ], $status = 200, );
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle Data fetched successfully.',
                'vehicle' => array($getUserVehicle),
            ], $status = 200, );
        }

    }

    public function resetPasswordOfVehicle(Request $request)
    {

        $validator = Validator::make($request->json()->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                'status' => 'error',
                'message' => $messages,
            ], 200);
        }

        $getUserVehicle = UserVehicles::where('id', $request->id)->first();

        if (!$getUserVehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not registered.',
            ], $status = 200, );
        } else {
            $password = $this->generateRandomString(10);

            $updatetouser = User::where('phone', $getUserVehicle->vehicle_number)->first();
            $updatetouser->password = Hash::make($password);
            $updatetouser->save();

            $getUserVehicle->passcode = $password;
            $getUserVehicle->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully.',
            ], $status = 200, );
        }

    }

    public function getTransactionHistory()
    {
        $transactions = Job::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();

        foreach ($transactions as $tran) {
            $tran->vehicle_details = UserVehicles::where('id', $tran->vehicle_id)->get(['id', 'vehicle_number', 'vehicle_brand_id', 'vehicle_model_id', 'vehicle_category_id'])->first();
            $tran->vehicle_details->brand_name = VehicleBrand::where('id', $tran->vehicle_details->vehicle_brand_id)->first()->name;
            $tran->vehicle_details->model_name = VehicleModel::where('id', $tran->vehicle_details->vehicle_model_id)->first()->name;
            $tran->vehicle_details->category_name = VehicleCategory::where('id', $tran->vehicle_details->vehicle_category_id)->first()->name;
            $tran->vehicle_details->brand_image = VehicleBrand::where('id', $tran->vehicle_details->vehicle_brand_id)->first()->image;
            $tran->vehicle_details->model_year = VehicleModel::where('id', $tran->vehicle_details->vehicle_model_id)->first()->year;
            $tran->date = date('d-m-Y', strtotime($tran->created_at));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Transactions fetched successfully.',
            'transactions' => $transactions,
        ], $status = 200, );
    }

}
