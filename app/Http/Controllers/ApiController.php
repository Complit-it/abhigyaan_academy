<?php

namespace App\Http\Controllers;

use App\Models\BrandCtaegoryMapping;
use App\Models\ProblemQuestions;
use App\Models\PushNotifications;
use App\Models\SaveFirebaseTokens;
use App\Models\Services;
use App\Models\ServicesProviderType;
use App\Models\StudentBatchToStudent;
use App\Models\VehicleBrand;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function update(Request $request)
    {
        // error_log($request);
        $value = $request->all();
        $vali = [];
        $var = [
            'phone_no' => 'numeric',
            'name' => 'nullable',
            'email' => 'nullable',
            'aadhaar_no' => 'nullable',
            'account_no' => 'nullable',
            'accholder_name' => 'nullable',
            'bank_name' => 'nullable',
            'branch_name' => 'nullable',
            'ifsc_code' => 'nullable',
            'pan_no' => 'nullable',
            'name_pan' => 'nullable',
            'gst_no' => 'nullable',
            'gst_name' => 'nullable',
            'lat' => 'nullable',
            'long' => 'nullable',
            'otp' => 'nullable',
            'job' => 'nullable',
            'job_disc' => 'nullable',
            'brand' => 'nullable',
            'model' => 'nullable',
            'area' => 'nullable',
            'servics' => 'nullable',
            'fcm_token' => 'nullable',
            'address' => 'nullable',
            'category' => 'nullable',
        ];
        foreach ($value as $k => $v) {
            error_log("$k, $v");
            $vali[$k] = $var[$k];
        }
        $validator = Validator::make($request->all(), $vali);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([array(
                'message' => $messages,
            )], 500);
        } else {

            $phone_no = $request->input('phone_no');
            DB::table('workers')
                ->where('phone_no', $phone_no)
                ->update($value);
            return response()->json([
                'message' => 'Successfully',
            ], $status = 200, );
        }
    }
    public function getAll(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|digits:12',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json([array(
                'message' => $messages,
            )], 500);
        }
        $result = DB::table('workers')
            ->where('phone_no', $request['phone_no'])
            ->first();
        if ($result) {
            // error_log($result);
            return response()->json([
                'message' => $result,
            ], $status = 200, );
        } else {
            return response()->json([
                'message' => "No user found",
            ], $status = 200, );
        }
    }
    public function jobLists()
    {
        $jobs = DB::table('job_lists')->select('job', 'job_dic')->get();
        return response()->json($jobs);
    }
    public function notification(Request $request)
    {

        $result = DB::table('workers')
            ->select('notification')
            ->where('phone_no', $request['phone_no'])
            ->first();
        return response()->json([
            'message' => $result,
        ], );
    }
    public function delnotification(Request $request)
    {

        $result = DB::table('workers')
            ->where('phone_no', $request['phone_no'])
            ->update(['notification' => null]);
        return response()->json([
            'message' => "Successfully",
        ], $status = 200);
    }
    public function get_brand()
    {
        $brand_list = DB::table('brand_model_lists')
            ->get("brand");
        error_log($brand_list);
        return response()->json($brand_list);
    }

    public function get_brand_model(Request $request)
    {
        $brand = $request->input('brand', []);

        $model_lists = DB::table('brand_model_lists')
            ->whereIn('brand', $brand)
            ->get("model");

        return response()->json($model_lists);

    }

    public function getBrandNew()
    {
        $brands = VehicleBrand::select('id', 'name as brand', 'description', 'image')->get()->toArray();

        $allBrands = [
            "id" => 0,
            "brand" => "All",
            "description" => null,
            "image" => "images\\vehicle_brand\\mahindra.png",
        ];

        // Add the "All" brand to the beginning of the $brands array
        array_unshift($brands, $allBrands);

        return response()->json($brands);
    }

    public function getServices()
    {
        $services = ServicesProviderType::select('id', 'name as job', "preliminaryService")->get();
        foreach ($services as $service) {
            if ($service->preliminaryService == 1) {
                $service->job_dic = "{Preliminary Check Up}";
            } else {
                $service->job_dic = "";
            }
            // // Join the new job names into a string
            // $job_str = "{" . implode(",", $jobs) . "}";
            // $service->job_dic = $job_str;
        }
        return response()->json($services);
    }

    public function getNewBrandModels(Request $request)
    {
        $brand = $request->input('brand', []);
        $results = [];

        foreach ($brand as $key => $value) {
            //Get Id of the brand
            $brandId = VehicleBrand::where('name', $value)->first();
            $models = VehicleModel::where('vehicleBrandId_fk', $brandId->id)->pluck('name')->toArray();
            // $jobs = ServiceSubCategory::where('serviceId_fk', $service->id)->pluck('name')->toArray();
            $results[$key]["id"] = $brandId->id;
            $results[$key]["brand"] = $brandId->name;
            // Join the new job names into a string
            $job_str = "{" . implode(",", $models) . "}";
            $results[$key]["model"] = $job_str;
        }

        return response()->json($results);
    }

    public function getNewBrandModelsByCategory()
    {
        $jsonData = json_decode(file_get_contents('php://input'), true);
        $modelString = $jsonData['category'];
        $result = [];

        // if the array contains 0  in it then send models of all brand
        if (in_array(0, $modelString)) {
            $getAllBrands = VehicleCategory::select('id')->get()->toArray();
            $modelString = $getAllBrands;
        }
        foreach ($modelString as $key => $value) {
            //Get Id of the brand
            $category = VehicleCategory::where('id', $value)->first();
            $brand = VehicleBrand::where('id', $category->vehicleBrandId_fk)->first();

            $models = VehicleModel::join('vehicle_categories', 'vehicle_models.vehicleCategoryId_fk', 'vehicle_categories.id')
                ->join('vehicle_brands', 'vehicle_categories.vehicleBrandId_fk', 'vehicle_brands.id')
                ->where('vehicle_models.vehicleCategoryId_fk', $category->id)
                ->select('vehicle_models.id as id', 'vehicle_models.name as model_name', 'vehicle_models.year')
                ->get();

            // add option all to each brand as a model
            $models->prepend(array(
                "id" => $brand->id . "All",
                "model_name" => $category->name . "- All Models",
                "year" => "All",
            ));

            $result[$key]["brand_id"] = $brand->id;
            $result[$key]["brand_name"] = $brand->name;
            $result[$key]["category_id"] = $category->id;
            $result[$key]["category_name"] = $category->name;
            $result[$key]["models"] = $models;
        }

        return response()->json($result);
    }

    public function updateFcmToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|digits:10',
            'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json([array(
                'message' => $messages,
            )], 500);
        }

        //

        $result = SaveFirebaseTokens::create([
            'phone' => $request->phone_no,
            'token' => $request->fcm_token,
            'role' => 'worker',
        ]);
        return response()->json([
            'status' => 'success',
            'message' => "FCM token Saved Successfully",
        ], $status = 200);
    }

    public function getVehicleServiceList(Request $request)
    {
        // parse the JSON string from the post request and extract the model names
        $jsonData = json_decode(file_get_contents('php://input'), true);
        $modelString = $jsonData['model'];
        $modelString = str_replace(array('{', '}'), '', $modelString);
        $modelNames = explode(',', $modelString);

        // initialize an empty array to store the vehicle model data
        $vehiclesServices = array();

        // if the array modelNames contains All  in it then send models of all brand
        if (in_array("All", $modelNames)) {

            $vehiclesServices = array([
                "id" => 0,
                "brand" => "All",
                "model" => "All",
                "service" => "All",
                "year" => date("Y"),
                "ful_name" => "All",
            ]);

        } else {

            // iterate through the model names and retrieve the corresponding vehicle model records
            foreach ($modelNames as $modelName) {
                $vehicleModel = VehicleModel::where('name', $modelName)->first();
                if ($vehicleModel) {
                    // add the vehicle model data to the array
                    $services = VehicleService::
                        join('vehicle_models', 'vehicle_services.vehicleModelId_fk', 'vehicle_models.id')
                        ->join('vehicle_categories', 'vehicle_models.vehicleCategoryId_fk', 'vehicle_categories.id')
                        ->join('services', 'services.id', 'vehicle_services.vehicleServiceId_fk')
                        ->join('vehicle_brands', 'vehicle_brands.id', 'vehicle_categories.vehicleBrandId_fk')
                        ->where('vehicleModelId_fk', $vehicleModel->id)
                        ->get(['vehicle_services.id as id', 'vehicle_brands.name as brand_name', 'vehicle_models.name as model_name',
                            'vehicle_models.year as model_year', 'services.name as service_name']);

                    // iterate through the services and add them to the array
                    foreach ($services as $service) {
                        $vehiclesServices[] = array(
                            'id' => $service->id,
                            'brand' => $service->brand_name,
                            'model' => $service->model_name,
                            'service' => $service->service_name,
                            'year' => $service->model_year,
                            'ful_name' => $service->brand_name . ' ' . $service->model_name . ' (' . $service->model_year . ')-' . $service->service_name,
                        );
                    }
                }
            }
        }

        // return the vehicle model data as a JSON response
        return response()->json($vehiclesServices);

        // echo "Hello";

    }

    public function getAllNotification()
    {
        $jsonData = json_decode(file_get_contents('php://input'), true);
        $role = $jsonData['role'];
        $getNotifications = PushNotifications::where('sendTo', $role)->orderBy('id', 'DESC')->get();
        return response()->json($getNotifications);

    }

    public function getCategories()
    {
        $jsonData = json_decode(file_get_contents('php://input'), true);

        $brand = $jsonData['brand'];

        // $brand = $request->input('brand', []);
        $results = [];

        // if $brand conatins All then get all categories
        if (in_array("All", $brand)) {
            $brands = VehicleBrand::select('id')->get()->toArray();
            $brand = $brands;

        }
        foreach ($brand as $key => $value) {
            //Get Id of the brand
            $brandId = VehicleBrand::where('name', $value)->first();
            $models = VehicleCategory::where('vehicleBrandId_fk', $brandId->id)->select('id', 'name')->get();
            // $jobs = ServiceSubCategory::where('serviceId_fk', $service->id)->pluck('name')->toArray();

            // preponnd all Models to each category
            $models->prepend(array(
                "id" => $brandId->id . "All",
                "name" => $brandId->name . "- All Models",
            ));

            $results[$key]["id"] = $brandId->id;
            $results[$key]["brand"] = $brandId->name;
            // // Join the new job names into a string
            // $job_str = "{" . implode(",", $models) . "}";
            $results[$key]["category"] = $models;

        }

        // return response()->json($brandId);
        return response()->json($results);
        // return response()->json(array("id" => '1', "brand" => "Toyota", "category" => "{SUV, Sedan, Hatchback}"));

    }

    public function getVehicleCategory(Request $request)
    {
        $jsonData = $request->modelId;
        $modelId = $jsonData;
        $getModel = VehicleModel::where('id', $modelId)->first();
        $getServices = Services::where('serviceId_fk', $getModel->vehicleCategoryId_fk)->select()->get();
        return response()->json($getServices);
    }

    public function getVehicleCategoryFromBrand(Request $request)
    {
        $jsonData = $request->brandId;
        $modelId = $jsonData;
        // Assuming $getServices contains an array of category IDs
        $categoryIds = BrandCtaegoryMapping::where('brand_id', $modelId)->pluck('category_id')->toArray();
        // Fetch VehicleCategory records based on the filtered category IDs
        $categories = VehicleCategory::whereIn('id', $categoryIds)->get();
        // echo
        return response()->json($categories);
    }

    public function getVehicleModelFromCategory(Request $request)
    {
        $jsonData = $request->categoryId;
        $modelId = $jsonData;
        $getServices = VehicleModel::where('vehicleCategoryId_fk', $modelId)->select()->get();
        return response()->json($getServices);
    }

    public function servicesFromServiceType(Request $request)
    {
        $jsonData = $request->ssptype;
        $modelId = $jsonData;
        $getServices = Services::where('serviceproviderId_fk', $modelId)->select()->get();
        return response()->json($getServices);
    }

    public function getServiceDetailsByBrand(Request $request)
    {
        $jsonData = $request->brandId;

        $getServices = VehicleService::
            join('vehicle_models', 'vehicle_models.id', 'vehicle_services.vehicleModelId_fk')
            ->join('vehicle_categories', 'vehicle_categories.id', 'vehicle_models.vehicleCategoryId_fk')
            ->join('vehicle_brands', 'vehicle_brands.id', 'vehicle_models.vehicleBrandId_fk')
            ->join('services', 'services.id', 'vehicle_services.vehicleServiceId_fk')
            ->join('services_provider_types', 'services_provider_types.id', 'services.serviceproviderId_fk')
            ->where('vehicle_brands.id', $jsonData)
            ->get(
                [
                    'vehicle_services.id as id', 'vehicle_brands.name as brand_name',
                    'vehicle_models.name as model_name', 'vehicle_categories.name as category_name', 'vehicle_models.year as model_year',
                    'services.name as service_name',
                    'services_provider_types.name as services_provider_type',
                ]
            );

        // row.id,
        // row.brand_name,
        // row.model_name,
        // row.category_name,
        // row.service_name,
        // row.services_provider_type,

        return response()->json($getServices);
    }

    public function getQuestionsByBrand(Request $request)
    {
        $jsonData = $request->brandId;
        $modelId = $jsonData;

        $getServices = ProblemQuestions::join('vehicle_brands', 'vehicle_brands.id', 'problem_questions.brandId')
            ->join('vehicle_categories', 'vehicle_categories.id', 'problem_questions.categoryId')
            ->join('vehicle_models', 'problem_questions.modelId', 'vehicle_models.id')
            ->join('problem_categories', 'problem_categories.id', 'problem_questions.categoryId')
            ->where('brandId', $modelId)

        // ->join('services_provider_types', 'services_provider_types.id', 'problem_questions.serviceproviderId_fk')
        // ->join('services', 'services.id', 'problem_questions.serviceId_fk')
        // ->join('vehicle_categories', 'vehicle_categories.id', 'problem_questions.categoryId')
        // ->join('vehicle_models', 'vehicle_models.id', 'problem_questions.modelId')
            ->get(['problem_categories.name as pc', 'problem_questions.id as id', 'vehicle_brands.name as brand_name', 'problem_questions.question as question',
                'vehicle_categories.name as category_name', 'problem_questions.question_type as question_type', 'problem_questions.total_options as total_options',
                'problem_questions.priority as priority', 'vehicle_models.name as model_name',

            ]);
        return response()->json($getServices);
    }

    // public function getRsaforme(Request $request)
    // {
    //     $lat = $request->lat;
    //     $long = $request->long;
    //     $radius = 10;
    //     $getRSA = DB::table('workers')
    //         ->where('preliminaryService', '1')
    //         ->select('name', 'phone_no', 'area', 'lat', 'long', DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( long ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
    //         ->having('distance', '<', $radius)
    //         ->get();

    //     while ($getRSA == null) {
    //         $radius = $radius + 5;
    //         $getRSA = DB::table('workers')
    //             ->where('preliminaryService', '1')
    //             ->select('name', 'phone_no', 'area', 'lat', 'long', DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( long ) - radians(' . $long . ') ) + sin( radians(' . $lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
    //             ->having('distance', '<', $radius)
    //             ->get();
    //     }

    //     return response()->json($getRSA);
    // }

    public function getVehicleModel(Request $request)
    {

        $brandId = $request->brandId;
        $categoryId = $request->categoryId;
        $getModels = VehicleModel::where('vehicleBrandId_fk', $brandId)->where('vehicleCategoryId_fk', $categoryId)->get();
        return response()->json($getModels);
    }

    public function deletemyaccount($phone)
    {
        echo "Your account has been set up for deletion if youdo not login again within 45 days your account will be deleted.";
    }

    public function add_students_to_batch(Request $request)
    {
        $data = $request->all();

        $batch_id = $data["batch_id"];
        $selctedStudents = $data['selected_students'];

        for ($i = 0; $i < count($selctedStudents); $i++) {
            $student = StudentBatchToStudent::where("studentId", $selctedStudents[$i])->first();
            if ($student != null) {

            } else {
                $insertStudent = new StudentBatchToStudent();
                $insertStudent->batchId = $batch_id;
                $insertStudent->studentId = $selctedStudents[$i];
                $insertStudent->save();
            }
        }
        echo json_encode(array('status' => 'success', 'message' => 'Student Added Successfully'));
    }

    

}
