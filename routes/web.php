<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileControler;
use App\Http\Controllers\YouTubeController;

// include all the  routes from dynamicformbuilder.php;

include 'dynamicformbuilder.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|  */

use Illuminate\Support\Facades\Route;


Route::get('blog/why-abhigyan-academy-is-the-best-defence-coaching-in-assam-edit', function () {
    // redirect to our-service/web-development
    return redirect('blog/why-abhigyan-academy-is-the-best-defence-coaching-in-assam');
});


// Route::get('/auth/google', [YouTubeController::class, 'redirectToGoogle']);
// Route::get('/auth/google/callback', [YouTubeController::class, 'handleGoogleCallback']);
// Route::post('/create-stream', [YouTubeController::class, 'createLiveStream']);
Route::get('/create-stream', [YouTubeController::class, 'createLiveStreamGet']);

Route::get('/auth/google', [YouTubeController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [YouTubeController::class, 'handleGoogleCallback']);
Route::get('/create-stream-form', [YouTubeController::class, 'showCreateStreamForm']);
Route::post('/create-stream', [YouTubeController::class, 'createLiveStream']);
Route::get('/create_stream', [YouTubeController::class, 'createLiveStreamRecfromGoogle']);

Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('login');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'loginpost'])->name('login');
Route::post('/login', [AuthController::class, 'loginpost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', 'App\Http\Controllers\MasterData@index')->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// })->name('/');

Route::get('/privacy', function () {
    return view('privacy', [
        'title' => 'Privacy Policy | Abhigyan Academy',
        'meta_description' => 'Read Abhigyan Academy’s Privacy Policy to understand how we protect and use your personal information.',
        'meta_keywords' => 'privacy policy, Abhigyan Academy, data protection, personal information',
    ]);
})->name('privacy');

Route::get('/terms-and-conditions', function () {
    return view('tnc', [
        'title' => 'Terms and Conditions | Abhigyan Academy',
        'meta_description' => 'Review the Terms and Conditions for using Abhigyan Academy’s services and website.',
        'meta_keywords' => 'terms and conditions, Abhigyan Academy, user agreement, website policies',
    ]);
})->name('terms-and-conditions');

Route::get('/disclaimer', function () {
    return view('disclaimer', [
        'title' => 'disclaimer | Abhigyan Academy',
        'meta_description' => 'Review the disclaimer for using Abhigyan Academy’s services and website.',
        'meta_keywords' => 'disclaimer, Abhigyan Academy',
    ]);
})->name('disclaimer');


Route::get('/', 'App\Http\Controllers\MasterData@index')->name('/');
// Route::get('/enquireform', 'App\Http\Controllers\MasterData@index')->name('/');
Route::post('/', 'App\Http\Controllers\MasterData@enquireform')->name('/');
Route::get('/contact', 'App\Http\Controllers\MasterData@contact')->name('contact');
Route::get('/about-us', 'App\Http\Controllers\MasterData@aboutus')->name('aboutus');
Route::get('/blogs', 'App\Http\Controllers\MasterData@blogs')->name('blogs');

Route::get('/courses', 'App\Http\Controllers\MasterData@courses')->name('courses');
Route::get('/course-detail/{code}', 'App\Http\Controllers\MasterData@courseDetail')->name('course-detail');

Route::get('/blog/{slug}', 'App\Http\Controllers\MasterData@bloginDetail')->name('blogs');

Route::post('/newsletters', 'App\Http\Controllers\MasterData@newsletters')->name('newsletters');
Route::post('/contact-form', 'App\Http\Controllers\MasterData@contactForm')->name('contact');

// student-login
Route::post('student-login', [AuthController::class, 'loginpost'])->name('student-login');
Route::post('sign-up', [AuthController::class, 'studentSignup'])->name('sign-up');
Route::get('sign-up', 'App\Http\Controllers\MasterData@index')->name('sign-up');
Route::get('/fetchAndSaveReviews', 'App\Http\Controllers\FetchGoogleReviewController@fetchAndSaveReviews')->name('fetchAndSaveReviews');


// Route::get('/home', [HomePage::class, 'render'])->name('home');
// Route::get('/contact', [ContactUs::class, 'render'])->name('contact');

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
    Route::get('/enquires', 'App\Http\Controllers\MasterData@enquires')->name('enquires');

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

    //MCQs
    Route::get('/mcqs', 'App\Http\Controllers\ResourcesData@mcqs')->name('mcqs');
    Route::post('/mcqs', 'App\Http\Controllers\ResourcesData@addMcqPost')->name('mcqs');
    Route::get('/edit-mcq-batch/{id}', 'App\Http\Controllers\ResourcesData@editMcq')->name('mcqs');
    Route::post('/edit-mcq-batch', 'App\Http\Controllers\ResourcesData@updateMcq')->name('mcqs');
    Route::get('/delete-mcq-batch/{id}', 'App\Http\Controllers\ResourcesData@deleteMcq')->name('mcqs');

    Route::get('/videos', 'App\Http\Controllers\ResourcesData@videos')->name('videos');
    Route::post('/videos', 'App\Http\Controllers\ResourcesData@addVideos')->name('videos');
    Route::get('/edit-video/{id}', 'App\Http\Controllers\ResourcesData@editVideo')->name('videos');
    Route::post('/edit-video', 'App\Http\Controllers\ResourcesData@updateVideo')->name('videos');
    Route::get('/delete-video/{id}', 'App\Http\Controllers\ResourcesData@deleteVideo')->name('delete-videos');

    //pdfs
    Route::get('/pdf', 'App\Http\Controllers\ResourcesData@pdfs')->name('pdfs');
    Route::post('/pdf', 'App\Http\Controllers\ResourcesData@addPdfs')->name('pdfs');
    Route::get('/edit-pdf/{id}', 'App\Http\Controllers\ResourcesData@editPdf')->name('pdfs');
    Route::post('/edit-pdf', 'App\Http\Controllers\ResourcesData@updatePdf')->name('pdfs');
    Route::get('/delete-pdf/{id}', 'App\Http\Controllers\ResourcesData@deletePdf')->name('delete-pdfs');

    //gallery
    Route::get('/gallery', 'App\Http\Controllers\ResourcesData@gallery')->name('gallery');
    Route::post('/gallery', 'App\Http\Controllers\ResourcesData@addGallery')->name('gallery');
    Route::get('/edit-gallery/{id}', 'App\Http\Controllers\ResourcesData@editGallery')->name('gallery');
    Route::post('/edit-gallery', 'App\Http\Controllers\ResourcesData@updateGallery')->name('gallery');
    Route::get('/delete-gallery/{id}', 'App\Http\Controllers\ResourcesData@deleteGallery')->name('delete-gallery');

    //packages

    Route::get('/packages', 'App\Http\Controllers\ResourcesData@packages')->name('packages');
    Route::post('/packages', 'App\Http\Controllers\ResourcesData@addPackagePost')->name('packages');
    Route::get('/edit-package/{id}', 'App\Http\Controllers\ResourcesData@editPackage')->name('packages');
    Route::post('/edit-packages', 'App\Http\Controllers\ResourcesData@updatePackage')->name('packages');
    Route::get('/suspend-package/{id}', 'App\Http\Controllers\ResourcesData@deletePackage')->name('packages');

    Route::get('/add-package-data/{id}', 'App\Http\Controllers\ResourcesData@addpackagedata')->name('add-package-data');
    // add-package-data
    Route::post('/add-package-data', 'App\Http\Controllers\ResourcesData@addpackagedataPost')->name('add-package-data');
    Route::post('/delete-package-data', 'App\Http\Controllers\ResourcesData@deletePackageDta')->name('delete-package-data');
    //

    // view-students

    Route::get('/view-students', 'App\Http\Controllers\ResourcesData@viewStudents')->name('view-students');

    // add-blogs
    Route::get('/add-blogs', 'App\Http\Controllers\Blogs@addBlogs')->name('add-blogs');
    Route::post('/add-blogs', 'App\Http\Controllers\Blogs@addBlogsPost')->name('add-blogs');
    Route::get('/edit-blog/{id}', 'App\Http\Controllers\Blogs@editBlogs')->name('edit-blog');
    Route::post('/edit-blog', 'App\Http\Controllers\Blogs@updateBlogs')->name('edit-blog');
    Route::post('/edit-blog', 'App\Http\Controllers\Blogs@updateBlogs')->name('edit-blog');

    // batch
    Route::get('/batch', 'App\Http\Controllers\ResourcesData@batch')->name('batch');
    Route::post('/batch', 'App\Http\Controllers\ResourcesData@batchPost')->name('batch');
    Route::get('/edit-batch/{id}', 'App\Http\Controllers\ResourcesData@editbatch')->name('edit-batch');
    Route::post('/edit-batch', 'App\Http\Controllers\ResourcesData@editbatchPost')->name('edit-batch');

    //view Batch Students
    Route::get('/view-batch-students/{batchId}', 'App\Http\Controllers\ResourcesData@viewStidentsinBatch')->name('view-batch-students');
    Route::get('/delete-batch-student/{studentId}/{batchId}', 'App\Http\Controllers\ResourcesData@deleteStidentsinBatch')->name('delete-batch-student');

    // contact-form-submission
    Route::get('/contact-form-submission', 'App\Http\Controllers\ResourcesData@cfs')->name('vcontact-form-submission');

    //atendance
    Route::get('/mark-attendance/{batchId}', 'App\Http\Controllers\ResourcesData@markattendance')->name('mark-attendance');
    Route::post('/mark-attendance', 'App\Http\Controllers\ResourcesData@markattendancePost')->name('mark-attendance');

    // fetchAndSaveReviews

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

    //go youtube Live
    Route::get('/go-live', 'App\Http\Controllers\YouTubeController@goLive')->name('go-live');
    // landing-page
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



Route::get('/loginwithgoogle', 'App\Http\Controllers\GoogleLoginController@loginwithgoogle')->name('loginwithgoogle');
Route::get('/oauth2callback', 'App\Http\Controllers\GoogleLoginController@oauth2callback')->name('oauth2callback');



// Route::get('/blog/why-abhigyan-academy-is-the-best-defence-coaching-in-assam-edit', function () {
//     return redirect('/blog/why-abhigyan-academy-is-the-best-defence-coaching-in-assam');
// });




Route::get('/free_resources', 'App\Http\Controllers\MasterData@free_resources')->name('free_resources');
Route::get('/biology', 'App\Http\Controllers\MasterData@biology')->name('biology');
Route::get('/chemistry', 'App\Http\Controllers\MasterData@chemistry')->name('chemistry');
Route::get('/economics', 'App\Http\Controllers\MasterData@economics')->name('economics');
Route::get('/environment', 'App\Http\Controllers\MasterData@environment')->name('environment');
Route::get('/geography', 'App\Http\Controllers\MasterData@geography')->name('geography');
Route::get('/history', 'App\Http\Controllers\MasterData@history')->name('history');
Route::get('/maths', 'App\Http\Controllers\MasterData@maths')->name('maths');
Route::get('/physics', 'App\Http\Controllers\MasterData@physics')->name('physics');
Route::get('/polity', 'App\Http\Controllers\MasterData@polity')->name('polity');
Route::get('/current_affairs', 'App\Http\Controllers\MasterData@current_affairs')->name('current_affairs');





Route::get('/nda_course', 'App\Http\Controllers\MasterData@nda_course')->name('nda_course');
Route::get('/cds_course', 'App\Http\Controllers\MasterData@cds_course')->name('cds_course');
Route::get('/afcat_course', 'App\Http\Controllers\MasterData@afcat_course')->name('afcat_course');
Route::get('/capf_course', 'App\Http\Controllers\MasterData@capf_course')->name('capf_course');
Route::get('/ssb_course', 'App\Http\Controllers\MasterData@ssb_course')->name('ssb_course');
Route::get('/coast_guard_course', 'App\Http\Controllers\MasterData@coast_guard_course')->name('coast_guard');