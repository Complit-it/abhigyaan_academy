<?php

namespace App\Http\Controllers;

use App\Models\BrandCtaegoryMapping;
use Illuminate\Http\Request;

use App\Models\ProblemCategory;

use App\Models\AuditTrail;
use App\Models\Banners;
use App\Models\Options;
use App\Models\ProblemQuestions;
use App\Models\PushNotifications;
use App\Models\Services;
use App\Models\ServicesProviderType;
use App\Models\User;
use App\Models\ProblemCategorytoProblemMapping;
use App\Models\VehicleBrand;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\VehicleService;
use App\Models\worker;

use App\Models\QuestionsToCustomer;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Validator;
use Exception; // Make sure this line is present if you are using the Exception class.



class ProblemController extends Controller
{
    //

    public function problemCategory()
    {
        $allcategories = ProblemCategory::select()->get();
        return view('adminPages.problemCategory', [
            'title' => 'AdminPortal | Add problem Category',
            'allcategories' => $allcategories,
            'selectSubCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function problemCategoryPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $allcategories = ProblemCategory::select()->get();

            return view('adminPages.problemCategory', [
                'title' => 'AdminPortal |  Add problem Category',
                'selectSubCatId' => null,
                'allcategories' => $allcategories,
                'alertDescription' => 'problem Category name or Image required',
                'alertTitle' => 'Error',
                'alertIcon' => 'error',
            ]);
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/problem-category/');
            $image->move($destinationPath, $pathName);
        }else{
            $pathName = 'default.png';
        }

       

        $addCity = ProblemCategory::create([
            'name' => $request->name,
            'image' => 'images/problem-category/' . $pathName,

        ]);

        AdminController::updateAuditTrail('New problem Category Added'. json_encode($addCity));

        $allcategories = ProblemCategory::select()->get();
        return view('adminPages.problemCategory', [
            'title' => 'AdminPortal | Add problem Category',
            'selectSubCatId' => null,
            'allcategories' => $allcategories,
            'editId' => null,

            'alertDescription' => 'Problem Category added successfully',
            'alertTitle' => 'Success',
            'alertIcon' => 'success',
        ]);
    }

    public function deleteproblemCategory($id)
    {
       
        $delete = ProblemCategory::where('id', $id)->first();
        AdminController::updateAuditTrail('Deleted problem Category '. json_encode($delete));
        if ($delete) {
            $this->deleteExistingFile($delete->image);
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return back()->with('message', 'Problem Model Deleted.');
        }
    }

    public function editproblemCategory($id)
    {
        // $allSubcategories = ProblemCategory::with('problemBrand')->get();
        $allcategories = ProblemCategory::select()->get();
        $selectSubCatId = ProblemCategory::where('id', $id)->first();

        AdminController::updateAuditTrail('Edit problem Category for '. json_encode($selectSubCatId));

        return view('adminPages.problemCategory', [
            'title' => 'AdminPortal | Add Problem Category',
            // 'allSubcategories' => $allSubcategories,
            'allcategories' => $allcategories,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateproblemCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $allcategories = ProblemCategory::select()->get();
            return view('adminPages.problemCategory', [
                'title' => 'AdminPortal |  Add problem Category',
                'selectSubCatId' => null,
                'allcategories' => $allcategories,
                'editId' => null,
                'alertDescription' => 'problem Category name required',
                'alertTitle' => 'Error',
                'alertIcon' => 'error',
            ]);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = problemBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = ProblemCategory::where('id', $request->id)->first();
            if ($delete) {
                $this->deleteExistingFile($delete->image);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/problem-category/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/problem-category/' . $name;
            $addCity = ProblemCategory::where('id', $request->id)->update([
                'name' => $request->name,
                'image' => $imagePath,
            ]);

        } else {

            $addCity = ProblemCategory::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        
        AdminController::updateAuditTrail('Updated problem Category '. json_encode($addCity));

        }

        $allcategories = ProblemCategory::select()->get();

        return view('adminPages.problemCategory', [
            'title' => 'AdminPortal |  Add problem Category',
            'selectSubCatId' => null,
            'editId' => null,
            'allcategories' => $allcategories,
            'alertDescription' => 'Problem Category added successfully',
            'alertTitle' => 'Success',
            'alertIcon' => 'success',
        ]);
    }

    // problemCategorytoProblemsMapping
    
    public function problemCategorytoProblemsMapping(){

        $allBrands = ProblemCategory::select()->get();
        $allCategories = Services::join('services_provider_types', 'services_provider_types.id', 'services.serviceproviderId_fk')->select([
            'services.id as id',
            'services.name as name',
            'services_provider_types.name as providerType',
        ])->get();

        $selectSubCatId = null;
        $allMappings = ProblemCategorytoProblemMapping::
        join('problem_categories', 'problem_categories.id', 'problem_categoryto_problem_mappings.problem_category_id')
        ->join('services', 'services.id', 'problem_categoryto_problem_mappings.service_id')
        ->join('services_provider_types', 'services_provider_types.id', 'services.serviceproviderId_fk')
        ->select([
            'problem_categoryto_problem_mappings.id as id',
            'problem_categories.name as pc',
            'services.name as service',
            'services_provider_types.name as providerType',
        
        ])->get();

        return view('adminPages.problemCategorytoProblemsMapping', [
            'title' => 'AdminPortal | Brand Category Mapping',
            'allBrands' => $allBrands,
            'allcategories' => $allCategories,
            'allMappings' => $allMappings,
            'alertDescription' => null,
            'alertTitle' => null,
            'editId' => null,
            'brandId' => null,
            'selectSubCatId' => $selectSubCatId,
            'alertIcon' => null,
        ]);
    }

    public function problemCategorytoProblemsMappingPost(Request $request){
        $validator = Validator::make($request->all(), [
            'brandId' => 'required|min:1',
            'categoryId' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Brand and Category required');
        }
        if($request->brandId < 0){
            return back()->with('error', 'Please select a brand');
        }
        for($i = 0; $i < count($request->categoryId); $i++){

            $getProblemDetails = Services::where('id', $request->categoryId[$i])->first();
          
            $checkForSame = ProblemCategorytoProblemMapping::where('problem_category_id', $request->brandId)
            ->where('service_provider_id', $getProblemDetails->serviceproviderId_fk)
            ->where('service_id', $request->categoryId[$i])
            ->first();
            if ($checkForSame) {
            }else{
                $addData = ProblemCategorytoProblemMapping::create([
                    'problem_category_id' => $request->brandId,
                    'service_provider_id' => $getProblemDetails->serviceproviderId_fk,
                    'service_id' => $request->categoryId[$i],
                ]); 
                AdminController::updateAuditTrail('Brand Category Mapped'. json_encode($addData));
            }
        }
        return back()->with('message', 'Brand and Category mapped successfully');
    }

    public function deleteBrandCategoryMapping($id)
    {
        $delete = ProblemCategorytoProblemMapping::where('id', $id)->first();
        if ($delete) {
            AdminController::updateAuditTrail('Deleted Brand Category Mapping '. json_encode($delete));
            try {
                $delete->delete();
                return back()->with('message', 'Brand Category Mapping Deleted.');
            } catch (Exception $e) {
                return back()->with('error', 'Could not delete as it is associated with some Vehicle Model.');
            }
            return back()->with('message', 'Brand Category Mapping Deleted.');
        }
    }


    // problemQuestions
    public function problemQuestionaire()
    {
        $vehicleBrand = VehicleBrand::select()->get();
        $ssptype = ServicesProviderType::select()->get();
        $problemCategory = ProblemCategory::select()->get();

        
        // $getCategory = VehicleCategory::where('vehicleBrandId_fk', $selectCatId->brandId)->get();
        // $getModel = VehicleModel::where('vehicleCategoryId_fk', $selectCatId->categoryId)->get();

        return view('adminPages.problemQuestionaire', [
            'title' => 'AdminPortal | Problem Questionaire',
            'allBanners' => array(),
            'vehicleBrand' => $vehicleBrand,
            'ssptype' => $ssptype,
            'problemCategory' => $problemCategory,

            'selectCatId' => null,
            'getCategory' => null,
            // 'getBrand' => $getBrand,
            'getModel' => null,
            'options' => null,
            'getCategory' => array(),
            'getModel' => array(),

            'singleOffer' => array(),
            'catagories' => array(),
            'allOffers' => array(),
            'selectSubCatId' => null,
            'editId' => null,
        ]);
    }
    

    public function problemQuestionairePost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'brandId' => 'required|min:1',
            'categoryId' => 'required|min:1',
            'modelId' => 'required|min:1',
            'question' => 'required',
            'problemmcategory' => 'required',
        ]);
        if ($validator->fails()) {

            // echo json_encode($validator->errors());
            return back()->with('message', $validator->errors());
        }

        $questionId = ProblemQuestions::create([
            'brandId' => $request->brandId,
            'categoryId' => $request->categoryId,
            'modelId' => $request->modelId,
            'question' => $request->question,
            'question_type' => 'text',
            'total_options' => '0',
            'priority' => '10',
            'problem_category_id' => $request->problemmcategory,
        ])->id;


        AdminController::updateAuditTrail('New problem Question Added'. json_encode($questionId));

        return back()->with('success', 'Question added successfully');
    }

    public function deleteQuestion(Request $request)
    {
        $id = $request->id;
        $delete = ProblemQuestions::where('id', $id)->first();
        if ($delete) {
            //delete options
            $options = Options::where('question_id', $delete->id)->delete();
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            // redirect to /problem-questionaire with message laravel
            AdminController::updateAuditTrail('Deleted problem Question '. json_encode($delete));
            return redirect('/problem-questionaire')->with('danger', 'Question Deleted.');

            // ('/problem-questionaire')->with('danger', 'Question Deleted.');
            return back()->with('danger', 'Question Deleted.');
        }
    }

    public function editQuestion(Request $request)
    {
        $id = $request->id;
        $selectCatId = ProblemQuestions::where('id', $id)->first();
        $vehicleBrand = VehicleBrand::select()->get();
        $getModels = VehicleModel::where('vehicleCategoryId_fk', $selectCatId->categoryId)->get();
        $getCategories = BrandCtaegoryMapping::
        join('vehicle_categories', 'vehicle_categories.id', 'brand_ctaegory_mappings.category_id')
        ->join('vehicle_brands', 'vehicle_brands.id', 'brand_ctaegory_mappings.brand_id')
        ->where('brand_id', $selectCatId->brandId)->get([
            'brand_ctaegory_mappings.id as id',
            'vehicle_categories.name as name',
        ]);

        $ssptype = ServicesProviderType::select()->get();
        $problemCategory = ProblemCategory::select()->get();

        return view('adminPages.problemQuestionaire', [
            'title' => 'AdminPortal | Problem Questionaire',
            'allBanners' => array(),
            'vehicleBrand' => $vehicleBrand,
            'ssptype' => $ssptype,
            'problemCategory' => $problemCategory,
            'selectCatId' => $selectCatId,
            'getCategory' => null,
            'getModel' => null,
            'options' => null,
            'getCategory' => $getCategories,
            'getModel' => $getModels,
            'singleOffer' => array(),
            'catagories' => array(),
            'allOffers' => array(),
            'selectSubCatId' => null,
            'editId' => null,
        ]);
    }


    public function pquestions()
    {
        $allCategories = ProblemCategory::select()->get();

        $allQuestions = QuestionsToCustomer::
        join('problem_categories', 'problem_categories.id', 'questions_to_customers.problem_category_id' )->select(
            'questions_to_customers.id as id',
            'questions_to_customers.question as question',
            'problem_categories.name as category'
        )->get();
        
        return view('adminPages.questionsToCustomer', [
            'title' => 'AdminPortal | Add Category',
            'allcategories' => $allCategories,
            'selectCatId' => null,
            'allQuestions' => $allQuestions,
            'editId' => null,
            // 'alertDescription' => 'Invalid OTP',
            // 'alertTitle' => 'Error',
            // 'alertIcon' => 'error'
        ]);
    }


    public function pquestionsPost (Request $request){

        $validator = Validator::make($request->all(), [
            'question' => 'required|min:1',
            'problemCategory' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Question and Category required');
        }

        for ($i=0; $i < count($request->problemCategory); $i++) {
            $addCity = QuestionsToCustomer::create([
                'question' => $request->question,
                'problem_category_id' => $request->problemCategory[$i],
            ]);
            AdminController::updateAuditTrail('New problem Question Added'. json_encode($addCity));
            }
        return back()->with('message', 'Question added successfully');
    }

    public function deletePquestions($id)
    {
        $delete = QuestionsToCustomer::where('id', $id)->first();
        if ($delete) {
            AdminController::updateAuditTrail('Deleted problem Question '. json_encode($delete));
            $delete->delete();
            return back()->with('message', 'Question Deleted.');
        }
    }

   



    public function deleteExistingFile($imagePath)
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }

}
