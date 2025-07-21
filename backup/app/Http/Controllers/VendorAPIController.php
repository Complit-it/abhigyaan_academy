<?php

namespace App\Http\Controllers;

use App\Models\BrandCtaegoryMapping;
use App\Models\ServicesProviderType;
use App\Models\VehicleBrand;
use App\Models\VehicleCategory;
use App\Models\VendorDetails;
use App\Models\VendorService;
use App\Models\VendorWorkingBrand;
use App\Models\VendorWorkingCategory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OTPVerification;

use Validator;
use Illuminate\Support\Facades\DB;


class VendorAPIController extends Controller
{
 
    public function otp(Request $request)
    {
        error_log($request);
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|digits:12',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json([
                'code' => '200',
                'status' => 'error',
                'message' => $messages,
            ]);
        }
        // if phone no present in TestPhoneNo then don't send otp

        // check if the phone number is already Registered
      

        if (in_array($request->phone_no, TestPhone::testPhone())) {
            $otp = 123456;

            $worker = User::where('phone', $request['phone_no'])->first();
            if ($worker) {
                $otpVerification = OTPVerification::where('phone_no', $request->phone_no)->first();
                if(!$otpVerification){
                    $otpVerification = new OTPVerification();
                    $otpVerification->phone_no = $request->phone_no;
                }
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();

                // DB::table('workers')
                //     ->where('phone_no', $request['phone_no'])
                //     ->update(['otp' => $otp]);
            } else {
               
                $newUser = new User();
                $newUser->name = 'Vendor';
                $newUser->email = $request->phone_no . '@gmail.com';
                $newUser->phone = $request->phone_no;
                $newUser->password = Hash::make($otp);
                $newUser->save();

                $user = User::where('phone', $request->phone_no)->first();
                // addRole to the user
                $addRole = DB::table('role_user')->insert([
                    'role_id' => 3,
                    'user_id' => $user->id,
                    'user_type' => 'App\Models\User',
                    
                ]); 

                $otpVerification = new OTPVerification();
                $otpVerification->phone_no = $request->phone_no;
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();
            }
        } else {
            $otp = rand(100000, 999999);
            $numbers = array((int) $request['phone_no']);
            $sender = urlencode('CMPLIT');
            $worker = User::where('phone', $request['phone_no'])->first();
            if ($worker) {
                $otpVerification = OTPVerification::where('phone_no', $request->phone_no)->first();
                if(!$otpVerification){
                    $otpVerification = new OTPVerification();
                    $otpVerification->phone_no = $request->phone_no;
                }
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();
            } else {
            

                $newUser = new User();
                $newUser->name = 'Vendor';
                $newUser->email = $request->phone_no . '@gmail.com';
                $newUser->phone = $request->phone_no;
                $newUser->password = Hash::make($otp);
                $newUser->save();

                //get the user id
                $user = User::where('phone', $request->phone_no)->first();
                // addRole to the user
                $addRole = DB::table('role_user')->insert([
                    'role_id' => 3,
                    'user_id' => $user->id,
                    'user_type' => 'App\Models\User',
                ]); 


                $otpVerification = new OTPVerification();
                $otpVerification->phone_no = $request->phone_no;
                $otpVerification->otp = SHA1($otp);
                $otpVerification->valid_upto = now()->addMinutes(5);
                $otpVerification->status = 0;
                $otpVerification->save();

            }
            $message = 'Your OTP for logging into RoadPartner is ' . $otp . '. Please do not share your OTP with anyone.';
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
    
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'OTP Sent Successfully',
        ]);
    }
    

    //
    public function checkOtp(Request $request)
    {
        $valiodator = Validator::make($request->all(), [
            'phone_no' => 'required',
            'otp' => 'required',
        ]);

        if ($valiodator->fails()) {
            return response()->json([
                'code' => '200',
                'status' => 'error',
                'message' => 'Validation Error',
            ]);
        }

        $status = 'error';
        $message = 'Invalid OTP.';

        $phone_no = $request->phone_no;
        $otp = $request->otp;

        $users = User::where('phone', $request->phone_no)->first();
        if (!$users) {
            return response()->json([
                'code' => '200',
                'status' => 'error',
                'message' => 'Phone Number not registered',
            ]);
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
            $user = User::where('phone', $request->phone_no)->first();

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


    public function whichScreen(Request $request){

        $userId = Auth::id();
        $user = User::find($userId);
        $screen = '';

        $checkService = VendorService::where('user_id', $user->id)->first();
        $vendorDetails = VendorDetails::where('user_id', $user->id)->first();
        $checkCategory = VendorWorkingCategory::where('user_id', $user->id)->first();
        $checkBrand = VendorWorkingBrand::where('user_id', $user->id)->first();
        $checkPreferedArea = VendorDetails::where('user_id', $user->id)->first();


        if(!$checkService && $screen == ''){
            $screen = 'WhoareyouScreen';
        }
        else if(!$checkCategory && $screen == ''){
            $screen = 'CategoryScreen';
        }
        else if(!$checkBrand  && $screen == ''){
            $screen = 'BrandScreen';
        }else if(!$checkPreferedArea && $screen == ''){
            $screen = 'PreferedAreaScreen';
        }
        else if(!$vendorDetails  && $screen == ''){
            $screen = 'WhoareyouScreen';
        }
        else if($vendorDetails->prelimiary_check == null && $screen == ''){
            $screen = 'PrelimiaryCheckScreen';
        }

        //Personal Details
        else if($vendorDetails->pan_no == null && $screen == ''){
            $screen = 'PersonalProfileScreen';
        }
        else if($vendorDetails->gst_no == null && $screen == ''){
            $screen = 'PersonalProfileScreen';
        }
        else if($vendorDetails->aadhar_no == null && $screen == ''){
            $screen = 'PersonalProfileScreen';
        }
        else if($vendorDetails->latitude == null && $screen == ''){
            $screen = 'PersonalProfileScreen';
        }
        else if($vendorDetails->longitude == null && $screen == ''){
            $screen = 'PersonalProfileScreen';
        }
        // Bank Details
        else if($vendorDetails->bank_name == null && $screen == ''){
            $screen = 'BankDetailsScreen';
        }
        else if($vendorDetails->bank_ifsc_code == null && $screen == ''){
            $screen = 'BankDetailsScreen';
        }
        else if($vendorDetails->bank_branch == null && $screen == ''){
            $screen = 'BankDetailsScreen';
        }
        else if($vendorDetails->bank_account_no == null && $screen == ''){
            $screen = 'BankDetailsScreen';
        }

        // else if($vendorDetails->vendor_aadhar_front == null && $screen == ''){
        //     $screen = 'AadharFrontScreen';
        // }
        // else if($vendorDetails->vendor_aadhar_back == null && $screen == ''){
        //     $screen = 'AadharBackScreen';
        // }
        // else if($vendorDetails->vendor_pan_card == null && $screen == ''){
        //     $screen = 'PANCardScreen';
        // }
        // else if($vendorDetails->vendor_gst_certificate == null && $screen == ''){
        //     $screen = 'GSTCertificateScreen';
        // }
        // else if($vendorDetails->vendor_address_proof == null && $screen == ''){
        //     $screen = 'AddressProofScreen';
        // }

        
        
        else{
            $screen = 'HomeScreen';
        }
        
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'OTP Sent Successfully',
            'screen' => $screen
        ]);
    }

    public function allServicesTypes(){
        $allService = ServicesProviderType::select()->orderBy('name', 'ASC')->get();
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'All Services',
            'data' => $allService
        ]);
    }


    public function saveData(Request $request){
        $userId = Auth::id();
        $user = User::find($userId);
        $vendorDetails = VendorDetails::where('user_id', $user->id)->first();

        if($vendorExists = VendorDetails::orderBy('id', 'desc')->first()){
            $lastIsertedId = $vendorExists->id + 1;
        }else{
            $lastIsertedId = 1;
        }

        if(!$vendorDetails){
            $vendorDetails = new VendorDetails();
            $vendorDetails->user_id = $user->id;
            $vendorDetails->vendor_status = '1';
            $vendorDetails->vendor_code = date('Ymd').''.str_pad($lastIsertedId,  6, '0', STR_PAD_LEFT);
            $vendorDetails->save();
        }else{
            $vendorDetails->vendor_status = '1';
            $vendorDetails->save();
        }



        if($request->type == 'serviceType'){
            $addVendorWorkingCategory = VendorService::where('user_id', $user->id)->first();
            if(!$addVendorWorkingCategory){
                $addVendorWorkingCategory = new VendorService();
                $addVendorWorkingCategory->user_id = $user->id;
                $addVendorWorkingCategory->service_id = $request->id;
                $addVendorWorkingCategory->status = '1';
                $addVendorWorkingCategory->save();
            }
            else{
                $addVendorWorkingCategory->service_id = $request->id;
                $addVendorWorkingCategory->save();
            }
            
             return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Details Saved Successfully',
            ]);
        }else if($request->type == 'category'){
            $categoryId = json_decode($request->id);

            
            for($i = 0; $i < count($categoryId); $i++){
                $addVendorWorkingCategory = VendorWorkingCategory::where('user_id', $user->id)
                ->where('category_id', $categoryId[$i])->first();
                if(!$addVendorWorkingCategory){
                    $addVendorWorkingCategory = new VendorWorkingCategory();
                    $addVendorWorkingCategory->user_id = $user->id;
                    $addVendorWorkingCategory->category_id = $categoryId[$i];
                    $addVendorWorkingCategory->status = '1';
                    $addVendorWorkingCategory->save();
                }
            }
            
             return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Details Saved Successfully',
            ]);
        }else if($request->type == 'brands'){
            $categoryId = json_decode($request->id);

            
            for($i = 0; $i < count($categoryId); $i++){
                $addVendorWorkingCategory = VendorWorkingBrand::where('user_id', $user->id)
                ->where('brand_id', $categoryId[$i])->first();
                if(!$addVendorWorkingCategory){
                    $addVendorWorkingCategory = new VendorWorkingBrand();
                    $addVendorWorkingCategory->user_id = $user->id;
                    $addVendorWorkingCategory->brand_id = $categoryId[$i];
                    $addVendorWorkingCategory->status = '1';
                    $addVendorWorkingCategory->save();
                }
            }
             return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Details Saved Successfully',
            ]);
        }

        else if($request->type == 'preliminarycheck'){
            $vendorDetails = VendorDetails::where('user_id', $user->id)->first();
            if(!$vendorDetails){
                $vendorDetails = new VendorDetails();
                $vendorDetails->user_id = $user->id;
                $vendorDetails->prelimiary_check = $request->id;
                $vendorDetails->status = '1';
                $vendorDetails->save();
            }
            else{
                $vendorDetails->prelimiary_check = $request->id;
                $vendorDetails->save();
            }
            return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Details Saved Successfully',
            ]);
            
        }

        else if($request->type == 'personalDetails'){
            $vendorDetails = VendorDetails::where('user_id', $user->id)->first();
            $userDetails = User::find($user->id);
            $userDetails->name = $request->name;
            $userDetails->email = $request->email;
            $userDetails->save();
            if(!$vendorDetails){
                $vendorDetails = new VendorDetails();
                $vendorDetails->user_id = $user->id;
                if($request->pan_no != null){
                    $vendorDetails->pan_no = $request->pan_no;
                }
                if($request->gst_no != null){
                    $vendorDetails->gst_no = $request->gst_no;
                }
                if($request->aadhar_no != null){
                    $vendorDetails->aadhar_no = $request->aadhar_no;
                }
                if($request->latitude != null){
                    $vendorDetails->latitude = $request->latitude;
                }
                if($request->longitude != null){
                    $vendorDetails->longitude = $request->longitude;
                }
                if($request->address != null){
                    $vendorDetails->address_proof = $request->address;
                }
                $vendorDetails->save();
                return response()->json([
                    'code' => '200',
                    'status' => 'success',
                    'message' => 'Details Saved Successfully',
                ]);
            }
            else{
                if($request->pan_no != null){
                    $vendorDetails->pan_no = $request->pan_no;
                }
                if($request->gst_no != null){
                    $vendorDetails->gst_no = $request->gst_no;
                }
                if($request->aadhar_no != null){
                    $vendorDetails->aadhar_no = $request->aadhar_no;
                }
                if($request->latitude != null){
                    $vendorDetails->latitude = $request->latitude;
                }
                if($request->longitude != null){
                    $vendorDetails->longitude = $request->longitude;
                }
                if($request->address != null){
                    $vendorDetails->address_proof = $request->address;
                }
                $vendorDetails->save();
            }
            return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Personal Data Saved Successfully',
            ]);
        }else if($request->type == 'payment_details'){
            $vendorDetails = VendorDetails::where('user_id', $user->id)->first();
            if(!$vendorDetails){
                $vendorDetails = new VendorDetails();
                $vendorDetails->user_id = $user->id;
                
                if($request->bank_name != null){
                    $vendorDetails->bank_name = $request->bank_name;
                }
                if($request->bank_account_no != null){
                    $vendorDetails->bank_account_no = $request->bank_account_no;
                }
                if($request->bank_ifsc_code != null){
                    $vendorDetails->bank_ifsc_code = $request->bank_ifsc_code;
                }
                if($request->bank_branch != null){
                    $vendorDetails->bank_branch = $request->bank_branch;
                }
                $vendorDetails->save();

                return response()->json([
                    'code' => '200',
                    'status' => 'success',
                    'message' => 'Details Saved Successfully',
                ]);
               
            }
            else{
                if($request->bank_name != null){
                    $vendorDetails->bank_name = $request->bank_name;
                }
                if($request->bank_account_no != null){
                    $vendorDetails->bank_account_no = $request->bank_account_no;
                }
                if($request->bank_ifsc_code != null){
                    $vendorDetails->bank_ifsc_code = $request->bank_ifsc_code;
                }
                if($request->bank_branch != null){
                    $vendorDetails->bank_branch = $request->bank_branch;
                }

                $vendorDetails->save();
            }
            return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Bank Details Saved Successfully',
            ]);
        }else{
             return response()->json([
                'code' => '200',
                'status' => 'success',
                'message' => 'Something went Wrong',
            ]);
        }

        
        
       
    }


    public function getPersonalDetails(){
        $userId = Auth::id();
        $user = User::find($userId);
        $vendorDetails = VendorDetails::where('user_id', $user->id)->first();

        $personalDetails  = array(
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'pan_no' => $vendorDetails->pan_no,
            'gst_no' => $vendorDetails->gst_no,
            'aadhar_no' => $vendorDetails->aadhar_no,
            'latitude' => $vendorDetails->latitude,
            'longitude' => $vendorDetails->longitude,
            'address' => $vendorDetails->address_proof,
        );

        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'Personal Details',
            'data' => $personalDetails
        ]);
    }

    public function getBankDetails(){
        $userId = Auth::id();
        $user = User::find($userId);
        $vendorDetails = VendorDetails::where('user_id', $user->id)->first();

        $bankDetails  = array(
            'bank_name' => $vendorDetails->bank_name,
            'bank_account_no' => $vendorDetails->bank_account_no,
            'bank_ifsc_code' => $vendorDetails->bank_ifsc_code,
            'bank_branch' => $vendorDetails->bank_branch,
        );

        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'Bank Details',
            'data' => $bankDetails
        ]);
    }


    public function allCategories(){
        $allCategory = VehicleCategory::select()->orderBy('name', 'ASC')->get();
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'All Categories',
            'data' => $allCategory
        ]);
    }

    public function preliminaryCheck(){
        // $allBrands = VehicleBrand::select()->orderBy('name', 'ASC')->get();

        $options = array(array(
            'id' => 1,
            'name' => 'Yes'), array('id' => 0, 'name' => 'No')
        );
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'All Brands',
            'data' => $options
        ]);
    }


    public function brandsFromCategories(){

        $id = Auth::id();
        $user = User::find($id);
        // get all distinct categoryId from VendorWorkingCategory where user_id = $user->id
        $categoryIds = VendorWorkingCategory::where('user_id', $user->id)->pluck('category_id');

        //now get all the brands who has this category id
        $brands = VehicleBrand::join('brand_ctaegory_mappings', 'brand_ctaegory_mappings.brand_id', '=', 'vehicle_brands.id')
        ->whereIn('brand_ctaegory_mappings.category_id', $categoryIds)
        ->groupBy('vehicle_brands.id', 'vehicle_brands.name', 'vehicle_brands.description', 'vehicle_brands.image') // Group by all columns from the vehicle_brands table
        ->get(['vehicle_brands.id', 'vehicle_brands.name', 'vehicle_brands.description', 'vehicle_brands.image']);


        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'All Brands From the Categories selected',
            'data' => $brands
        ]);
    }


    public function generatePassportToken(){
        $userId = Auth::id();
        $user = User::find($userId);
        $vendorDetails = VendorDetails::where('user_id', $user->id)->first();
        $vendorDetails->vendor_status = '1';
        $vendorDetails->save();
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'Passport Token Generated Successfully',
        ]);
    }


    public function getHomepageData(){
        $userId = Auth::id();
        $user = User::find($userId);
       

        $data = array(
            'activejob' => '10',
            'todaysjob' => '20',
            'incometoday' => 'Rs. 40',
            'profilecomplted' => '78%',
        );

        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'Homepage Data',
            'data' => $data
        ]);
    }


    public function getUserData(Request $request){
        $userId = Auth::id();
        $user = User::find($userId);
      
        $requeredPageData = $request->page;

        if($requeredPageData == 'whoareyou'){
            $message = 'Displaying all selected description';
            $data = VendorService::
            join('services_provider_types', 'services_provider_types.id', '=', 'vendor_services.service_id')
            ->where('vendor_services.user_id', $user->id)
            ->select('services_provider_types.id', 'services_provider_types.name')
            ->orderBy('services_provider_types.name', 'ASC')
            ->get();

        }else if($requeredPageData == 'category'){
            $message = 'Displaying all selected description';
            $data = VendorWorkingCategory::
            join('vehicle_categories', 'vehicle_categories.id', '=', 'vendor_working_categories.category_id')
            ->where('vendor_working_categories.user_id', $user->id)
            ->select('vehicle_categories.id', 'vehicle_categories.name')
            ->orderBy('vehicle_categories.name', 'ASC')
            ->get();
        }
        else if($requeredPageData == 'brands'){
            $message = 'Displaying all selected description';
            $data = VendorWorkingBrand::
            join('vehicle_brands', 'vehicle_brands.id', '=', 'vendor_working_brands.brand_id')
            ->where('vendor_working_brands.user_id', $user->id)
            ->select('vehicle_brands.id', 'vehicle_brands.name')
            ->orderBy('vehicle_brands.name', 'ASC')
            ->get();
        }else if($requeredPageData == 'preliminarycheck'){
            $message = 'Displaying all selected description';
            $data = VendorDetails::where('user_id', $user->id)->first();
        }
        else{
            $message = 'Something went wrong';
            $data = '';
        }



        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);

    }
}
