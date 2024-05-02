<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\Banners;
use App\Models\Options;
use App\Models\ProblemQuestions;
use App\Models\PushNotifications;
use App\Models\Services;
use App\Models\ServicesProviderType;
use App\Models\User;
use App\Models\BrandCtaegoryMapping;
use App\Models\VehicleBrand;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\VehicleService;
use App\Models\worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Validator;
use Exception; // Make sure this line is present if you are using the Exception class.


class VehicleController extends Controller
{
    //
    
    public function vCategory()
    {
        $allcategories = VehicleCategory::select()->get();
        return view('adminPages.vehicleCategory', [
            'title' => 'AdminPortal | Add Vehicle Category',
            'allcategories' => $allcategories,
            'selectSubCatId' => null,
            'editId' => null,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function vCategorysPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $allcategories = VehicleCategory::select()->get();

            return view('adminPages.vehicleCategory', [
                'title' => 'AdminPortal |  Add Vehicle Category',
                'selectSubCatId' => null,
                'allcategories' => $allcategories,
                'alertDescription' => 'Vehicle Category name or Image required',
                'alertTitle' => 'Error',
                'alertIcon' => 'error',
            ]);
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/vehicle-category/');
            $image->move($destinationPath, $pathName);
        }else{
            $pathName = 'default.png';
        }

       

        $addCity = VehicleCategory::create([
            'name' => $request->name,
            'image' => 'images/vehicle-category/' . $pathName,

        ]);

        AdminController::updateAuditTrail('New Vehicle Category Added'. json_encode($addCity));

        $allcategories = VehicleCategory::select()->get();
        return view('adminPages.vehicleCategory', [
            'title' => 'AdminPortal | Add Vehicle Category',
            'selectSubCatId' => null,
            'allcategories' => $allcategories,
            'editId' => null,

            'alertDescription' => 'Vehicle Category added successfully',
            'alertTitle' => 'Success',
            'alertIcon' => 'success',
        ]);
    }

    public function deleteVCategory($id)
    {
       
        $delete = VehicleCategory::where('id', $id)->first();
        AdminController::updateAuditTrail('Deleted Vehicle Category '. json_encode($delete));
        if ($delete) {
            $this->deleteExistingFile($delete->image);
            // Delete the record
            $delete->delete();
            // Return to the previous page with a message
            return back()->with('message', 'Vehicle Model Deleted.');
        }
    }

    public function editVCategory($id)
    {
        // $allSubcategories = VehicleCategory::with('vehicleBrand')->get();
        $allcategories = VehicleCategory::select()->get();
        $selectSubCatId = VehicleCategory::where('id', $id)->first();

        AdminController::updateAuditTrail('Edit Vehicle Category for '. json_encode($selectSubCatId));

        return view('adminPages.vehicleCategory', [
            'title' => 'AdminPortal | Add Vehicle Category',
            // 'allSubcategories' => $allSubcategories,
            'allcategories' => $allcategories,
            'selectSubCatId' => $selectSubCatId,
            'alertDescription' => null,
            'alertTitle' => null,
            'alertIcon' => null,
        ]);
    }

    public function updateVCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $allcategories = VehicleCategory::select()->get();
            return view('adminPages.vehicleCategory', [
                'title' => 'AdminPortal |  Add Vehicle Category',
                'selectSubCatId' => null,
                'allcategories' => $allcategories,
                'editId' => null,
                'alertDescription' => 'Vehicle Category name required',
                'alertTitle' => 'Error',
                'alertIcon' => 'error',
            ]);
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = VehicleBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = VehicleCategory::where('id', $request->id)->first();
            if ($delete) {
                $this->deleteExistingFile($delete->image);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/vehicle-category/');
            $image->move($destinationPath, $name);
            $imagePath = 'images/vehicle-category/' . $name;
            $addCity = VehicleCategory::where('id', $request->id)->update([
                'name' => $request->name,
                'image' => $imagePath,
            ]);

        } else {

            $addCity = VehicleCategory::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        
        AdminController::updateAuditTrail('Updated Vehicle Category '. json_encode($addCity));

        }

        $allcategories = VehicleCategory::select()->get();

        return view('adminPages.vehicleCategory', [
            'title' => 'AdminPortal |  Add Vehicle Category',
            'selectSubCatId' => null,
            'editId' => null,
            'allcategories' => $allcategories,
            'alertDescription' => 'Vehicle Category added successfully',
            'alertTitle' => 'Success',
            'alertIcon' => 'success',
        ]);
    }


    public function vBrand()
    {
        $cities = VehicleBrand::select()->get();
        return view('adminPages.addBrand', [
            'title' => 'AdminPortal | Add Category',
            'cities' => $cities,
            'selectCatId' => null,
            // 'alertDescription' => 'Invalid OTP',
            // 'alertTitle' => 'Error',
            // 'alertIcon' => 'error'
        ]);
    }

    public function vBrandPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            $cities = ServicesProviderType::select()->get();
            return view('adminPages.addBrand', [
                'title' => 'AdminPortal | Add Vehicle Brand',
                'cities' => $cities,
                'selectCatId' => null,
                'alertDescription' => 'Vehicle Brand name required',
                'alertTitle' => 'Error',
                'alertIcon' => 'error',
            ]);
        }
        if($request->hasFile('image')){
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/brands/');
            $image->move($destinationPath, $pathName);
        }
        else{
            $pathName = 'default.png';
        }
        $addCity = VehicleBrand::create([
            'name' => $request->name,
            'image' => '/images/brands/' . $pathName,
        ]);

        AdminController::updateAuditTrail('New Vehicle Brand Added'. json_encode($addCity));
        $cities = VehicleBrand::select()->get();
        return view('adminPages.addBrand', [
            'title' => 'AdminPortal | Add Vehicle Brand',
            'cities' => $cities,
            'selectCatId' => null,

            'alertDescription' => 'Vehicle Brand added successfully',
            'alertTitle' => 'Success',
            'alertIcon' => 'success',
        ]);
    }

    //Delete service
    public function deleteVBrand($id)
    {
        $delete = VehicleBrand::where('id', $id)->first();
        if ($delete) {
            $this->deleteExistingFile($delete->image);
            // Delete the record
            AdminController::updateAuditTrail('Deleted Vehicle Brand '. json_encode($delete));
            try {
                $delete->delete();
                return back()->with('message', 'Vehicle Model Deleted.');
            } catch (Exception $e) {
                return back()->with('error', 'Could not delete as it is associated with some Vehicle Model.');
            }
            $delete->delete();
            // Return to the previous page with a message
            return back()->with('message', 'Vehicle Model Deleted.');
        }
    }

      //Update Vehicle Brand
      public function updateVBrand(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'name' => 'required|min:1',
          ]);
          if ($validator->fails()) {
              $allcategories = VehicleBrand::select()->get();
              return view('adminPages.addBrand', [
                  'title' => 'AdminPortal | Add Vehicle Model',
                  'selectSubCatId' => null,
                  'cities' => $allcategories,
                  'alertDescription' => 'Vehicle Brand name required',
                  'alertTitle' => 'Error',
                  'alertIcon' => 'error',
              ]);
          }
  
          if ($request->hasFile('image')) {
              //delete existing file from folder
              // $delete = VehicleBrand::where('id', $request->id)->first();
              // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
              $delete = VehicleBrand::where('id', $request->id)->first();
              if ($delete) {
                  $this->deleteExistingFile($delete->image);
              }
  
              $image = $request->file('image');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $destinationPath = public_path('/images/brands');
              $image->move($destinationPath, $name);
              $imagePath = 'images/brands/' . $name;
              $addCity = VehicleBrand::where('id', $request->id)->update([
                  'name' => $request->name,
                  'image' => $imagePath,
              ]);
          } else {
              $addCity = VehicleBrand::where('id', $request->id)->update([
                  'name' => $request->name,
              ]);
          }
          AdminController::updateAuditTrail('Updated Vehicle Brand '. json_encode($addCity));

  
          $allcategories = VehicleBrand::select()->get();
          return view('adminPages.addBrand', [
              'title' => 'AdminPortal | Add Vehicle Model',
              'selectCatId' => null,
              'cities' => $allcategories,
              'editId' => null,
  
              'alertDescription' => 'Vehicle Brand updated successfully',
              'alertTitle' => 'Success',
              'alertIcon' => 'success',
          ]);
      }

      public function editVBrand($id)
      {
  
          $allcategories = VehicleBrand::select()->get();
          return view('adminPages.addBrand', [
              'title' => 'AdminPortal | Add Vehicle Model',
              'selectSubCatId' => null,
              'cities' => $allcategories,
              'selectCatId' => VehicleBrand::where('id', $id)->first(),
  
              // 'alertDescription' => 'Vehicle Model added successfully',
              // 'alertTitle' => 'Success',
              // 'alertIcon' => 'success',
          ]);
  
      }


      public function vmodel()
      {
   
  
          $allSubcategories = VehicleModel::join('vehicle_categories', 'vehicle_categories.id', '=', 'vehicle_models.vehicleCategoryId_fk')
            ->join('vehicle_brands', 'vehicle_brands.id', '=', 'vehicle_models.vehicleBrandId_fk')
            ->get(['vehicle_models.*', 'vehicle_categories.name as categoryName', 'vehicle_brands.name as brandName']);
          $allcategories = VehicleCategory::select()->get();
          $allBrands = VehicleBrand::select()->get();

          if(count($allBrands) == 0){
            // redirect to add Brand page
            return redirect()->route('vehicle-brand')->with('message', 'Please add a vehicle brand first');
          }
  
          return view('adminPages.vehicleModel', [
              'title' => 'AdminPortal | Add Vehicle Model',
              'allSubcategories' => $allSubcategories,
              'allcategories' => $allcategories,
              'allBrands' => $allBrands,  
              'selectSubCatId' => null,
              'editId' => null,
              'brandId' => null,
              // 'alertDescription' => 'Invalid OTP',
              // 'alertTitle' => 'Error',
              // 'alertIcon' => 'error'
          ]);
      }


      
    //Add vehicle-model
    public function vModelPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brandId' => 'required|min:1',
            'categoryId' => 'required|min:1',
            'name' => 'required|min:1',

        ]);
        if ($validator->fails()) {
           return back()->with('message', 'Vehicle Model name or Image required');
        }
        if($request->categoryId < 1){
            return back()->with('error', 'Please select a category');
        }
        if($request->brandId < 1){
            return back()->with('error', 'Please select a brand');
        }

        if($request->hasFile('image')){
            $image = $request->file('image');
            $pathName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/vehicle-model/');
            $image->move($destinationPath, $pathName);
        }else{
            $pathName = 'default.png';
        }

        $checkForSame = VehicleModel::where('name', $request->name)->where('vehicleBrandId_fk', $request->brandId)->where('vehicleCategoryId_fk', $request->categoryId)->where('year', $request->year)->first();
        if ($checkForSame) {
            return back()->with('error', 'Vehicle Model already exists');
        }

        $addCity = VehicleModel::create([
            'name' => $request->name,
            'vehicleBrandId_fk' => $request->brandId,
            'vehicleCategoryId_fk' => $request->categoryId,
            'year' => $request->year,
            'image' => '/images/vehicle-model/' . $pathName,
        ]);

        AdminController::updateAuditTrail('New Vehicle Model Added'. json_encode($addCity));

        return back()->with('message', 'Vehicle Model added successfully');
    }

    public function deleteVModel($id)
    {
        $getDatafromModels = VehicleService::where('vehicleModelId_fk', $id)->first();
        if ($getDatafromModels) {
            return back()->with('message', 'Vehicle Model cannot be deleted as it is associated with some Vehicle Service.');
        }

        $delete = VehicleModel::where('id', $id)->first();

        if ($delete) {
            $imagePath = $delete->image; // Assuming 'image' is the column name in your table

            // Check if the image file exists
            if (Storage::disk('public')->exists($imagePath)) {
                // The image file exists
                // Delete the image file
                Storage::disk('public')->delete($imagePath);
            }
            AdminController::updateAuditTrail('Deleted Vehicle Model '. json_encode($delete));
            // Delete the record
            $delete->delete();
            return back()->with('message', 'Vehiicle Model Deleted.');

        } else {
            // Deletion failed or record not found
            return back()->with('message', 'Could not delete try again later.');
        }
    }

    public function editVModel($id)
    {

        $allSubcategories = VehicleModel::join('vehicle_categories', 'vehicle_categories.id', '=', 'vehicle_models.vehicleCategoryId_fk')
            ->join('vehicle_brands', 'vehicle_brands.id', '=', 'vehicle_models.vehicleBrandId_fk')
            ->get(['vehicle_models.*', 'vehicle_categories.name as categoryName', 'vehicle_brands.name as brandName']);
          $allcategories = VehicleCategory::select()->get();
          $allBrands = VehicleBrand::select()->get();

        $vehicleData = VehicleModel::where('id', $id)->first();

        return view('adminPages.vehicleModel', [
            'title' => 'AdminPortal | Add Vehicle Model',
            'allBrands' => $allBrands,
            'allSubcategories' => $allSubcategories,
            'selectSubCatId' => $vehicleData,
            'allcategories' => $allcategories,
            'editId' =>$vehicleData->vehicleCategoryId_fk,
            'brandId' => $vehicleData->vehicleBrandId_fk,
        ]);

    }

    // Update Vehicle Model
    public function updateVModel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brandId' => 'required|min:1',
            'categoryId' => 'required|min:1',
            'name' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Vehicle Model name, Category or Name  required');
        }
        if($request->categoryId < 1){
            return back()->with('error', 'Please select a category');
        }
        if($request->brandId < 1){
            return back()->with('error', 'Please select a brand');
        }

        if ($request->hasFile('image')) {
            //delete existing file from folder
            // $delete = VehicleBrand::where('id', $request->id)->first();
            // $imagePath = $delete->image; // Assuming 'image' is the column name in your table
            $delete = VehicleBrand::where('id', $request->id)->first();
            if ($delete) {
                $this->deleteExistingFile($delete->image);
            }

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/vehicle-model');
            $image->move($destinationPath, $name);
            $imagePath = 'images/vehicle-model/' . $name;

            $addCity = VehicleModel::where('id', $request->id)->update([
                'name' => $request->name,
                'vehicleCategoryId_fk' => $request->categoryId,
                'vehicleBrandId_fk' => $request->brandId,
                'year' => $request->year,
                'image' => $imagePath,

            ]);

        } else {

            $addCity = VehicleModel::where('id', $request->id)->update([
                'name' => $request->name,
                'vehicleCategoryId_fk' => $request->categoryId,
                'vehicleBrandId_fk' => $request->brandId,
                'year' => $request->year,

            ]);
        }

        AdminController::updateAuditTrail('Updated Vehicle Model '. json_encode($addCity));
        return redirect()->route('vehicle-model')->with('message', 'Vehicle Model updated successfully');
    }

    public function brandCategoryMapping(){

        $allBrands = VehicleBrand::select()->get();
        $allCategories = VehicleCategory::select()->get();

        $selectSubCatId = null;
        $allMappings = BrandCtaegoryMapping::join('vehicle_brands', 'vehicle_brands.id', '=', 'brand_ctaegory_mappings.brand_id')
            ->join('vehicle_categories', 'vehicle_categories.id', '=', 'brand_ctaegory_mappings.category_id')
            ->get(['brand_ctaegory_mappings.*', 'vehicle_brands.name as brandName', 'vehicle_categories.name as categoryName']);

        return view('adminPages.brandCategoryMapping', [
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

    public function brandCategoryMappingPost(Request $request){
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
          
            $checkForSame = BrandCtaegoryMapping::where('brand_id', $request->brandId)->where('category_id', $request->categoryId[$i])->first();
            if ($checkForSame) {
            }else{
                $addData = BrandCtaegoryMapping::create([
                    'brand_id' => $request->brandId,
                    'category_id' => $request->categoryId[$i],
                ]); 
                AdminController::updateAuditTrail('Brand Category Mapped'. json_encode($addData));
            }
        }
        return back()->with('message', 'Brand and Category mapped successfully');
    }

    public function deleteBrandCategoryMapping($id)
    {
        $delete = BrandCtaegoryMapping::where('id', $id)->first();
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


    public function deleteExistingFile($imagePath)
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }

}
