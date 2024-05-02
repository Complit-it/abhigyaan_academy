<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\MasterDataAPI;
use App\Http\Controllers\VendorAPIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::post('checkOtp', [ApiController::class, 'checkOtp']);

Route::post('get-topic', [MasterDataAPI::class, 'getTopicFromSubject']);
Route::post('get-sub-topic', [MasterDataAPI::class, 'getSubTopicFromTopic']);

Route::get('deletemyaccount/{phone}', [ApiController::class, 'getServices']);
Route::get('jobLists', [ApiController::class, 'getServices']);
// Route::post('get_brand_model', [ApiController::class, 'getNewBrandModels']);
Route::post('get_brand_model', [ApiController::class, 'getNewBrandModelsByCategory']);
Route::post('get_service_list', [ApiController::class, 'getVehicleServiceList']);
Route::get('get_brand', [ApiController::class, 'getBrandNew']);
Route::get('get_brand', [ApiController::class, 'getBrandNew']);

Route::post('update-fcm-token', [ApiController::class, 'updateFcmToken']);

Route::post('getAll', [ApiController::class, 'getAll']);
Route::post('getAllNotification', [ApiController::class, 'getAllNotification']);
Route::post('update', [ApiController::class, 'update']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('notification', [ApiController::class, 'notification']);
    Route::post('delnotification', [ApiController::class, 'delnotification']);
});

Route::post('get-vehicle-category', [ApiController::class, 'getVehicleCategory']);
Route::post('get-vehicle-category-from-brand', [ApiController::class, 'getVehicleCategoryFromBrand']);
Route::post('get-vehicle-model-from-category', [ApiController::class, 'getVehicleModelFromCategory']);
Route::post('get-services-from-service-type', [ApiController::class, 'servicesFromServiceType']);
Route::post('get-services-detail-by-brand', [ApiController::class, 'getServiceDetailsByBrand']);

// //new Routes
// Route::get('get-brands-new', [ApiController::class, 'getBrandNew']);
// Route::get('get-job-list', [ApiController::class, 'getServices']);
// Route::post('get_brand_model_new', [ApiController::class, 'getNewBrandModels']);

// routes for customerapp
Route::post('get-otp', [CustomerApiController::class, 'otp']);
Route::get('get-otp', [CustomerApiController::class, 'getnotsupported']);

Route::post('check-customer-otp', [CustomerApiController::class, 'checkOtp']);
Route::get('check-customer-otp', [CustomerApiController::class, 'getnotsupported']);

Route::post('login', [CustomerApiController::class, 'login']);
Route::get('login', [CustomerApiController::class, 'getnotsupported']);

Route::post('loginwithOTP', [CustomerApiController::class, 'loginwithOTP']);
Route::get('loginwithOTP', [CustomerApiController::class, 'getnotsupported']);

Route::post('forgot-password', [CustomerApiController::class, 'forgotPassword']);
Route::get('forgot-password', [CustomerApiController::class, 'getnotsupported']);

Route::post('reset-password', [CustomerApiController::class, 'resetPassword']);
Route::get('reset-password', [CustomerApiController::class, 'getnotsupported']);
Route::get('get-models-by-brand', [CustomerApiController::class, 'getnotsupported']);
Route::post('get-questions-by-brand', [ApiController::class, 'getQuestionsByBrand']);
// get-vehicle-model
Route::post('get-vehicle-model', [ApiController::class, 'getVehicleModel']);

// getBannersforHome
Route::get('get-banners-for-home', [CustomerApiController::class, 'getnotsupported']);
Route::get('get-customer-brands', [CustomerApiController::class, 'getCustomerBrand']);

Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
// Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
    Route::get('get-brands', [ApiController::class, 'getBrandNew']);
    Route::post('get-models-by-brand', [CustomerApiController::class, 'getModelsbyBrand']);
    Route::post('add-user-vehicle', [CustomerApiController::class, 'adduserVehicle']);
    Route::post('update-profile', [CustomerApiController::class, 'updateProfile']);
    Route::post('getquestions', [CustomerApiController::class, 'getquestions']);
    Route::post('get-rsa-me', [CustomerApiController::class, 'getMoreRSA']);
    Route::post('get-rsa-test', [CustomerApiController::class, 'getMoreRSA_working']);
    Route::post('get-user-services-by-category', [CustomerApiController::class, 'getUserServiceByCategory']);
    Route::post('get-approvalfrom-rsa', [CustomerApiController::class, 'getApprovalFromRsa']);
    Route::post('bookrsa', [CustomerApiController::class, 'bookrsa']);
    Route::get('get-user-vehicles', [CustomerApiController::class, 'getUserVehicles']);
    // Route::post('get-approvalfrom-rsa-test', [CustomerApiController::class, 'getApprovalFromRsa_working']);
    // Route::post('get-rsa-me', 'App\Http\Controllers\AdminController@getMoreRSA')->name('get-rsa-me');
    Route::post('request-rsa-for-job', [CustomerApiController::class, 'requestRSAforJob']);
    // get-transaction-history
    Route::get('get-transaction-history', [CustomerApiController::class, 'getTransactionHistory']);

});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('get-user-profile', [CustomerApiController::class, 'getUserProfile']);
    Route::get('get-banners-for-home', [CustomerApiController::class, 'getBannersforHome']);
    Route::post('vehicle-login-details', [CustomerApiController::class, 'vehiclelogindetails']);
    //resetpasswordofvehicle
    Route::post('reset-password-of-vehicle', [CustomerApiController::class, 'resetPasswordOfVehicle']);

});

Route::post('otp', [VendorAPIController::class, 'otp']);
Route::post('checkOtp', [VendorAPIController::class, 'checkOtp']);
Route::group(['middleware' => ['auth:api', 'role:vendors']], function () {
    Route::get('whichScreen', [VendorAPIController::class, 'whichScreen']);
    Route::get('allServicesTypes', [VendorAPIController::class, 'allServicesTypes']);
    Route::post('saveData', [VendorAPIController::class, 'saveData']);
    Route::get('allCategories', [VendorAPIController::class, 'allCategories']);
    Route::get('brandsFromCategories', [VendorAPIController::class, 'brandsFromCategories']);
    Route::get('preliminaryCheck', [VendorAPIController::class, 'preliminaryCheck']);
    Route::get('getPersonalDetails', [VendorAPIController::class, 'getPersonalDetails']);
    Route::get('getBankDetails', [VendorAPIController::class, 'getBankDetails']);
    Route::get('getHomepageData', [VendorAPIController::class, 'getHomepageData']);
    Route::post('getUserData', [VendorAPIController::class, 'getUserData']);

});

// Route::get('register', [CustomerApiController::class, 'getnotsupported']);
// Route::post('register', [CustomerApiController::class, 'register']);
