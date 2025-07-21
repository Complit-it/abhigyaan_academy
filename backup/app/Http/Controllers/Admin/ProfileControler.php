<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorDetails;
use App\Models\VendorPreferedArea;
use App\Models\VendorWorkingBrand;
use App\Models\VendorWorkingCategory;

use App\Models\VendorService;
use App\Models\worker;
use Illuminate\Support\Facades\DB;

class ProfileControler extends Controller
{
    public function dashboard()
    {
        $dashNumbers['experts'] = 450;
        $dashNumbers['vendors'] = 450;
        $dashNumbers['totalOrdersToday'] = 450;
        $dashNumbers['totalStocksToday'] = 450;

        $workers = DB::table('workers')->get();

        return view('adminPages.dashboard', [
            'title' => 'AdminPortal |  Dashboard | ',
            'dashNumbers' => $dashNumbers,
            'workers' => $workers,
            // 'alertDescription' => '',
            // 'alertTitle' => 'Cusomer Number Already Exists in our Record.',
            // 'alertIcon' => 'success'
        ]);
    }

    public function viewVendors()
    {

        $allVendors = VendorDetails::join('users', 'users.id', 'vendor_details.user_id')->get([
            'vendor_details.*',
            'users.name',
            'users.email',
            'users.phone'
        ]);

        for ($i = 0; $i < count($allVendors); $i++) {
            $allVendors[$i]->services = VendorService::
            join('services_provider_types', 'services_provider_types.id', 'vendor_services.service_id')
            ->where('user_id', $allVendors[$i]->user_id)->get();

            $allVendors[$i]->working_brand = VendorWorkingBrand::
            join('vehicle_brands', 'vehicle_brands.id', 'vendor_working_brands.brand_id')
            ->where('user_id', $allVendors[$i]->user_id)->get();

            $allVendors[$i]->working_category = VendorWorkingCategory::
            join('vehicle_categories', 'vehicle_categories.id', 'vendor_working_categories.category_id')
            ->where('user_id', $allVendors[$i]->user_id)->get();

            $allVendors[$i]->prefered_area = VendorPreferedArea::where('user_id', $allVendors[$i]->user_id)->get();
            
        }
      

        return view('adminPages.viewVendors', [
            'title' => 'AdminPortal | View Vendor',
            'workers' => $allVendors,
        ]);
    }

    public function sendnotification()
    {
        $workers = DB::table('workers')->get();
        // return response()->json(['allVendors'=>$allVendors], 200);

        return view('adminPages.sendNotifications', [
            'title' => 'AdminPortal | Send Notification',
        ]);
    }

    private function extractTrueValues($json, $key)
    {
        // Convert the JSON data into a PHP array
        $data = json_decode($json, true);

        // Check if the key exists in the data
        if (!isset($data[$key])) {
            return [];
        }

        // Loop through the object and extract the values that are true
        $trueValues = [];
        foreach ($data[$key] as $key => $value) {
            if ($value) {
                $trueValues[] = $key;
            }
        }

        // Output the true values
        return $trueValues;
    }

    public function suspendVendor($id)
    {
        $worker = VendorDetails::find($id);
        $worker->vendor_status = 0;
        $worker->save();

        return redirect()->back()->with('message', 'Vendor Suspended Successfully');
    }

    public function reviveVendor($id)
    {
        $worker = VendorDetails::find($id);
        $worker->vendor_status = 1;
        $worker->save();
        return redirect()->back()->with('message', 'Vendor Activated Successfully');
    }

    

}
