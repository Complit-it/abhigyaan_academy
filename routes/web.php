<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileControler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|  */

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'loginpost'])->name('login');
Route::post('/login', [AuthController::class, 'loginpost'])->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::get('/owners.php', function () {
//     return view('owners');
// });

// Route::get('/provider.php', function () {
//     return view('provider');
// });

// Route::get('/journey.php', function () {
//     return view('journey');
// });

// Route::get('/gov-info.php', function () {
//     return view('gov-info');
// });

// Route::get('/safety.php', function () {
//     return view('safety');
// });

// Route::get('/about.php', function () {
//     return view('about');
// });

// Route::get('/government-services', 'App\Http\Controllers\PublicController@gservices')->name('government-services');
// Route::get('/road-safety', 'App\Http\Controllers\PublicController@roadSafety')->name('road-safety');
// Route::get('/before-journey', 'App\Http\Controllers\PublicController@beforeJourney')->name('before-journey');

// Route::get('/generate-passport-token', 'App\Http\Controllers\TokenController@installPassport')->name('generate-passport-token');

Route::group(['middleware' => ['auth']], function () {

//     Route::get('/suspend-vendor/{id}', 'App\Http\Controllers\Admin\ProfileControler@suspendVendor')->name('suspend-vendor');
//     Route::get('/revive-vendor/{id}', 'App\Http\Controllers\Admin\ProfileControler@reviveVendor')->name('revive-vendor');

    Route::get('/dashboard', [ProfileControler::class, 'dashboard'])->name('dashboard');

    // app-banner
    Route::get('/app-banner', 'App\Http\Controllers\AdminController@appBanner')->name('app-banner');
    Route::post('/app-banner', 'App\Http\Controllers\AdminController@appBannerPost')->name('app-banner');
    Route::post('/delete-app-banner', 'App\Http\Controllers\AdminController@deleteAppBanner')->name('delete-app-banner');
    Route::post('/edit-app-banner', 'App\Http\Controllers\AdminController@editAppBanner')->name('edit-app-banner');
    Route::post('/edit-app-banner-post', 'App\Http\Controllers\AdminController@editAppBannerPost')->name('edit-app-banner-post');
    Route::get('/delete-app-banner', 'App\Http\Controllers\AdminController@appBanner')->name('delete-app-banner');
    Route::get('/edit-app-banner', 'App\Http\Controllers\AdminController@appBanner')->name('edit-app-banner');
    Route::get('/edit-app-banner-post', 'App\Http\Controllers\AdminController@appBanner')->name('edit-app-banner-post');

    //audit-trail
    Route::get('/auditTrail', 'App\Http\Controllers\AdminController@auditTrail')->name('auditTrail');

    //send notification
    Route::get('/sendnotification', 'App\Http\Controllers\Admin\ProfileControler@sendnotification')->name('sendnotification');
    Route::get('/add-notification', 'App\Http\Controllers\AdminController@sendnotification')->name('add-notification');
    Route::post('/add-notification', 'App\Http\Controllers\AdminController@sendnotificationPost')->name('add-notification');

    //subjects
    Route::get('/subjects', 'App\Http\Controllers\MasterData@addSubjectPage')->name('subjects');
    Route::post('/subjects', 'App\Http\Controllers\MasterData@addSubjectPost')->name('subjects');
    Route::get('/edit-subject/{id}', 'App\Http\Controllers\MasterData@editSubject')->name('subjects');
    Route::post('/edit-subject', 'App\Http\Controllers\MasterData@updateSubject')->name('subjects');
    Route::get('/delete-subject/{id}', 'App\Http\Controllers\MasterData@deleteSubject')->name('subjects');

    //Topics
    Route::get('/topics', 'App\Http\Controllers\MasterData@addTopicPage')->name('topics');
    Route::post('/topics', 'App\Http\Controllers\MasterData@addTopicPost')->name('topics');
    Route::get('/edit-topic/{id}', 'App\Http\Controllers\MasterData@editTopic')->name('topics');
    Route::post('/edit-topic', 'App\Http\Controllers\MasterData@updateTopic')->name('topics');
    Route::get('/delete-topic/{id}', 'App\Http\Controllers\MasterData@deleteTopic')->name('topics');

    // Sub Topics
    Route::get('/sub-topics', 'App\Http\Controllers\MasterData@addSubTopicPage')->name('sub-topics');
    Route::post('/sub-topics', 'App\Http\Controllers\MasterData@addSubTopicPost')->name('sub-topics');
    Route::get('/edit-sub-topic/{id}', 'App\Http\Controllers\MasterData@editSubTopic')->name('sub-topics');
    Route::post('/edit-sub-topic', 'App\Http\Controllers\MasterData@updateSubTopic')->name('sub-topics');
    Route::get('/delete-sub-topic/{id}', 'App\Http\Controllers\MasterData@deleteSubTopic')->name('sub-topics');

    // Sub Sub Topics
    Route::get('/sub-sub-topics', 'App\Http\Controllers\MasterData@addSubSubTopicPage')->name('sub-sub-topics');
    Route::post('/sub-sub-topics', 'App\Http\Controllers\MasterData@addSubSubTopicPost')->name('sub-sub-topics');
    Route::get('/edit-sub-sub-topic/{id}', 'App\Http\Controllers\MasterData@editSubSubTopic')->name('sub-sub-topics');
    Route::post('/edit-sub-sub-topic', 'App\Http\Controllers\MasterData@updateSubSubTopic')->name('sub-sub-topics');
    Route::get('/delete-sub-sub-topic/{id}', 'App\Http\Controllers\MasterData@deleteSubSubTopic')->name('sub-sub-topics');

//     Route::get('/viewVendors', 'App\Http\Controllers\Admin\ProfileControler@viewVendors')->name('viewVendors');
//     Route::post('/editVendorPost', 'App\Http\Controllers\Admin\ProfileControler@editVendorPost')->name('editVendorPost');
//     Route::post('/editVendor', 'App\Http\Controllers\Admin\ProfileControler@editVendor')->name('editVendor');

//     Route::get('/auditTrail', 'App\Http\Controllers\AdminController@auditTrail')->name('auditTrail');

//     Route::get('/service', 'App\Http\Controllers\AdminController@service')->name('service');
//     Route::post('/service', 'App\Http\Controllers\AdminController@servicePost')->name('service');
//     Route::get('/edit-service/{id}', 'App\Http\Controllers\AdminController@editService')->name('edit-service');
//     Route::post('/edit-service', 'App\Http\Controllers\AdminController@updateService')->name('edit-service');
//     Route::get('/edit-service', 'App\Http\Controllers\AdminController@service')->name('edit-service');
//     Route::get('/delete-service/{id}', 'App\Http\Controllers\AdminController@deleteService')->name('delete-service');

//     // vehicle-brand
//     Route::get('/vehicle-brand', 'App\Http\Controllers\VehicleController@vBrand')->name('vehicle-brand');
//     Route::post('/vehicle-brand', 'App\Http\Controllers\VehicleController@vBrandPost')->name('vehicle-brand');
//     Route::get('/delete-vehicle-brand/{id}', 'App\Http\Controllers\VehicleController@deleteVBrand')->name('delete-vehicle-brand');
//     Route::get('/edit-vehicle-brand/{id}', 'App\Http\Controllers\VehicleController@editVBrand')->name('edit-vehicle-brand');
//     Route::post('/edit-vehicle-brand', 'App\Http\Controllers\VehicleController@updateVBrand')->name('edit-vehicle-brand');
//     Route::get('/edit-vehicle-brand', 'App\Http\Controllers\VehicleController@vBrand')->name('edit-vehicle-brand');

//     Route::get('/service-sub-category', 'App\Http\Controllers\AdminController@sscategory')->name('service-sub-category');
//     Route::post('/service-sub-category', 'App\Http\Controllers\AdminController@sscategoryPost')->name('service-sub-category');
//     Route::get('/delete-sub-category/{id}', 'App\Http\Controllers\AdminController@dscategory')->name('delete-sub-category');
//     Route::get('/edit-sub-category/{id}', 'App\Http\Controllers\AdminController@editscategory')->name('edit-sub-category');
//     Route::post('/edit-sub-category', 'App\Http\Controllers\AdminController@updatescategory')->name('edit-sub-category');
//     Route::get('/edit-sub-category', 'App\Http\Controllers\AdminController@sscategory')->name('edit-sub-category');

//     //Add Vehicle model
//     Route::get('/vehicle-model', 'App\Http\Controllers\VehicleController@vModel')->name('vehicle-model');
//     Route::post('/vehicle-model', 'App\Http\Controllers\VehicleController@vModelPost')->name('vehicle-model');
//     Route::get('/delete-vehicle-model/{id}', 'App\Http\Controllers\VehicleController@deleteVModel')->name('delete-vehicle-model');
//     Route::get('/edit-vehicle-model/{id}', 'App\Http\Controllers\VehicleController@editVModel')->name('edit-vehicle-model');
//     Route::post('/edit-vehicle-model', 'App\Http\Controllers\VehicleController@updateVModel')->name('edit-vehicle-model');
//     Route::get('/edit-vehicle-model', 'App\Http\Controllers\VehicleController@vModel')->name('edit-vehicle-model');

//     // vehicle-services
//     Route::get('/vehicle-services', 'App\Http\Controllers\AdminController@vServices')->name('vehicle-services');
//     Route::post('/vehicle-services', 'App\Http\Controllers\AdminController@vServicesPost')->name('vehicle-services');
//     Route::get('/delete-vehicle-services/{id}', 'App\Http\Controllers\AdminController@deleteVServices')->name('delete-vehicle-services');
//     Route::get('/edit-vehicle-services/{id}', 'App\Http\Controllers\AdminController@editVServices')->name('edit-vehicle-services');
//     Route::post('/edit-vehicle-services', 'App\Http\Controllers\AdminController@updateVServices')->name('edit-vehicle-services');

//     // vehicle-category
//     Route::get('/vehicle-category', 'App\Http\Controllers\VehicleController@vCategory')->name('vehicle-category');
//     Route::post('/vehicle-category', 'App\Http\Controllers\VehicleController@vCategorysPost')->name('vehicle-category');
//     Route::get('/delete-vehicle-category/{id}', 'App\Http\Controllers\VehicleController@deleteVCategory')->name('delete-vehicle-category');
//     Route::get('/edit-vehicle-category/{id}', 'App\Http\Controllers\VehicleController@editVCategory')->name('edit-vehicle-category');
//     Route::post('/edit-vehicle-category', 'App\Http\Controllers\VehicleController@updateVCategory')->name('edit-vehicle-category');

//     // vehicle-services
//     Route::get('/view-vendor-services/{id}', 'App\Http\Controllers\AdminController@vendorServiceDetails')->name('view-vendor-services');
//     Route::get('/view-vendor-services', 'App\Http\Controllers\AdminController@viewVendors')->name('view-vendor-services');

//     // Route::get('/problem-questionaire', 'App\Http\Controllers\AdminController@problemQuestionaire')->name('problem-questionaire');
//     // Route::post('/problem-questionaire', 'App\Http\Controllers\AdminController@problemQuestionairePost')->name('problem-questionaire');

//     // delete-question
//     // Route::get('/delete-question/{id}', 'App\Http\Controllers\AdminController@deleteQuestion')->name('delete-question');
//     // Route::get('/edit-question/{id}', 'App\Http\Controllers\AdminController@editQuestion')->name('edit-question');

//     // brand-category-mapping
//     Route::get('/brand-category-mapping', 'App\Http\Controllers\VehicleController@brandCategoryMapping')->name('brand-category-mapping');
//     Route::post('/brand-category-mapping', 'App\Http\Controllers\VehicleController@brandCategoryMappingPost')->name('brand-category-mapping');
//     Route::get('/delete-brand-category-mapping/{id}', 'App\Http\Controllers\VehicleController@deleteBrandCategoryMapping')->name('delete-brand-category-mapping');
//     Route::get('/edit-brand-category-mapping/{id}', 'App\Http\Controllers\VehicleController@editBrandCategoryMapping')->name('edit-brand-category-mapping');
//     Route::post('/edit-brand-category-mapping', 'App\Http\Controllers\VehicleController@updateBrandCategoryMapping')->name('edit-brand-category-mapping');
//     Route::get('/edit-brand-category-mapping', 'App\Http\Controllers\VehicleController@brandCategoryMapping')->name('edit-brand-category-mapping');

//     //problem category
    Route::get('/problem-category', 'App\Http\Controllers\ProblemController@problemCategory')->name('problem-category');
//     Route::post('/problem-category', 'App\Http\Controllers\ProblemController@problemCategoryPost')->name('problem-category');
//     Route::get('/delete-problem-category/{id}', 'App\Http\Controllers\ProblemController@deleteProblemCategory')->name('delete-problem-category');
//     Route::get('/edit-problem-category/{id}', 'App\Http\Controllers\ProblemController@editProblemCategory')->name('edit-problem-category');
//     Route::post('/edit-problem-category', 'App\Http\Controllers\ProblemController@updateProblemCategory')->name('edit-problem-category');
//     Route::get('/edit-problem-category', 'App\Http\Controllers\ProblemController@problemCategory')->name('edit-problem-category');

//     // problem category to problems
//     Route::get('/problem-category-to-problems', 'App\Http\Controllers\ProblemController@problemCategorytoProblemsMapping')->name('problem-category-to-problems');
//     Route::post('/problem-category-to-problems', 'App\Http\Controllers\ProblemController@problemCategorytoProblemsMappingPost')->name('problem-category-to-problems');
//     Route::get('/delete-problem-category-to-problems/{id}', 'App\Http\Controllers\ProblemController@deleteProblemCategorytoProblemsMapping')->name('delete-problem-category-to-problems');
//     Route::get('/edit-problem-category-to-problems/{id}', 'App\Http\Controllers\ProblemController@editProblemCategorytoProblemsMapping')->name('edit-problem-category-to-problems');
//     Route::post('/edit-problem-category-to-problems', 'App\Http\Controllers\ProblemController@updateProblemCategorytoProblemsMapping')->name('edit-problem-category-to-problems');
//     Route::get('/edit-problem-category-to-problems', 'App\Http\Controllers\ProblemController@problemCategorytoProblemsMapping')->name('edit-problem-category-to-problems');

//     // Route::get('/problem-questionaire', 'App\Http\Controllers\ProblemController@problemQuestionaire')->name('problem-questionaire');
//     // Route::post('/problem-questionaire', 'App\Http\Controllers\ProblemController@problemQuestionairePost')->name('problem-questionaire');

//     Route::get('/delete-question/{id}', 'App\Http\Controllers\ProblemController@deleteQuestion')->name('delete-question');
//     Route::get('/edit-question/{id}', 'App\Http\Controllers\ProblemController@editQuestion')->name('edit-question');

//     Route::get('/problem-questionaire', 'App\Http\Controllers\ProblemController@pquestions')->name('problem-questionaire');
//     Route::post('/problem-questionaire', 'App\Http\Controllers\ProblemController@pquestionsPost')->name('problem-questionaire');
//     Route::get('/delete-question/{id}', 'App\Http\Controllers\ProblemController@deletePquestions')->name('delete-question');
//     Route::get('/edit-question/{id}', 'App\Http\Controllers\ProblemController@editPquestions')->name('edit-question');
//     Route::post('/edit-question', 'App\Http\Controllers\ProblemController@updatePquestions')->name('edit-question');
//     Route::get('/edit-question', 'App\Http\Controllers\ProblemController@pquestions')->name('edit-question');
});

// // //Routes for users which have auth access
// // Route::group(['middleware' => ['auth', 'role:administrator']], function () {
// //     Route::get('/dashboard', [ProfileControler::class, 'dashboard'])->name('dashboard');
// //     Route::get('/viewVendors', 'App\Http\Controllers\Admin\ProfileControler@viewVendors')->name('viewVendors');
// //     Route::post('/editVendorPost', 'App\Http\Controllers\Admin\ProfileControler@editVendorPost')->name('editVendorPost');
// //     Route::post('/editVendor', 'App\Http\Controllers\Admin\ProfileControler@editVendor')->name('editVendor');

// //     Route::get('/auditTrail', 'App\Http\Controllers\AdminController@auditTrail')->name('auditTrail');

// });

// // Route::get('/admin/dashboard',[ProfileControler::class,'data'])->name('data');
