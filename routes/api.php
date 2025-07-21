<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AppApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\DynamicFormBuilder;
use App\Http\Controllers\MasterDataAPI;
use App\Http\Controllers\PaymentController;
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

Route::post('add_students_to_batch', [ApiController::class, 'add_students_to_batch']);
Route::post('login', [AppApiController::class, 'login']);
Route::get('appBanners', [AppApiController::class, 'appBanners']);
Route::post('sign-up', [AuthController::class, 'studentSignupapi']);
Route::post('package-details', [AppApiController::class, 'packageDetails']);

Route::group(['middleware' => ['auth:api', 'role:customer']], function () {
    Route::get('all-courses', [AppApiController::class, 'allcourses']);
    Route::get('getSubjects/{packageId}', [AppApiController::class, 'getSubjects']);
    Route::get('topics/{subjectId}/{packageId}', [AppApiController::class, 'topic']);
    Route::get('subtopics/{topicId}/{subjectId}/{packageId}', [AppApiController::class, 'subtopic']);
    Route::get('subsubtopics/{subtopicId}/{topicId}/{subjectId}/{packageId}', [AppApiController::class, 'subsubtopic']);
    Route::get('contents/{subsubtopicId}/{subtopicId}/{topicId}/{subjectId}/{packageId}', [AppApiController::class, 'getContents']);

    Route::get('mcq-questions/{batchId}', [AppApiController::class, 'mcqquestions']);
    Route::get('mcqquestions/{batchId}', [AppApiController::class, 'mcqquestions']);
    Route::post('savMCQDetails', [AppApiController::class, 'savMCQDetails']);
    Route::get('get-profile', [AppApiController::class, 'getprofile']);
    Route::post('update-user-profile', [AppApiController::class, 'updateprofile']);
    Route::get('get-enrolled-courses', [AppApiController::class, 'getEnrolledCourses']);

    Route::post('check-user-package', [AppApiController::class, 'checkUserandPackages']);
    Route::post('get-video-details', [AppApiController::class, 'getVideoDetails']);
    Route::post('get-pdf', [AppApiController::class, 'getpdf']);
    Route::get('check-attempted-quizes', [AppApiController::class, 'checkattemptedquizes']);
    Route::get('check-individual-attempt/{id}', [AppApiController::class, 'checkindividualattemptedquizes']);

    Route::get('learn-recommended-practice/{packageId}', [AppApiController::class, 'learnrecommendedpractice']);
    Route::post('update-profile-image', [AppApiController::class, 'updateprofileimage']);
    Route::get('check-mcq-analytics/{id}', [AppApiController::class, 'getQuizAnalytics']);

    Route::get('user-profile-analytics/{id}', [AppApiController::class, 'getUserProfileAnalytics']);
    Route::post('save-streak', [AppApiController::class, 'saveStreak']);
    Route::get('get-user-streak/{id}', [AppApiController::class, 'getStreak']);

    Route::get('is-anything-changed', [AppApiController::class, 'isAnythingChanged']);
    // mark-change-updated
    Route::post('mark-change-updated', [AppApiController::class, 'markChangeUpdated']);

    //buy
    Route::post('buy/{packageId}', [AppApiController::class, 'buyCourse']);

});
// Route::post('checkOtp', [ApiController::class, 'checkOtp']);

Route::post('get-topic', [MasterDataAPI::class, 'getTopicFromSubject']);
Route::post('get-sub-topic', [MasterDataAPI::class, 'getSubTopicFromTopic']);
Route::post('get-sub-sub-topic', [MasterDataAPI::class, 'getSubSubTopicFromSubTopic']);

Route::post('check-slug', [MasterDataAPI::class, 'checkSlug'])->name('check-slug');

// get-data
Route::post('get-data', [MasterDataAPI::class, 'getData']);

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

// Route::post('login', [CustomerApiController::class, 'login']);
// Route::get('login', [CustomerApiController::class, 'getnotsupported']);

Route::post('loginwithOTP', [CustomerApiController::class, 'loginwithOTP']);
Route::get('loginwithOTP', [CustomerApiController::class, 'getnotsupported']);

Route::post('forgot-password', [CustomerApiController::class, 'forgotPassword']);
Route::get('forgot-password', [CustomerApiController::class, 'getnotsupported']);

Route::post('reset-password', [CustomerApiController::class, 'resetPassword']);
Route::get('reset-password', [CustomerApiController::class, 'getnotsupported']);
Route::get('get-models-by-brand', [CustomerApiController::class, 'getnotsupported']);
Route::post('get-questions-by-brand', [ApiController::class, 'getQuestionsByBrand']);
Route::post('add_students_to_batch', [ApiController::class, 'add_students_to_batch']);
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

    Route::post('/payment/add', [PaymentController::class, 'addPayment']);
    Route::post('/payment/add/to/userPackage', [PaymentController::class, 'addToUserPackageOnPaymentSuccess']);
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment']);

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

// get-landing-page-data/{id}
Route::get('/get-landing-page-data/{id}', [DynamicFormBuilder::class, 'getLandingPageData']);

// Route::get('register', [CustomerApiController::class, 'getnotsupported']);
// Route::post('register', [CustomerApiController::class, 'register']);
