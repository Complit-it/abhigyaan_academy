<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
// Assuming your State model is in the App\Models namespace

class IndianStates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['country_id' => 1, 'name' => 'Andaman and Nicobar Islands', 'state_code' => 'AN', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Andhra Pradesh', 'state_code' => 'AP', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Arunachal Pradesh', 'state_code' => 'AR', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Assam', 'state_code' => 'AS', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Bihar', 'state_code' => 'BR', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Chandigarh', 'state_code' => 'CH', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Chhattisgarh', 'state_code' => 'CG', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Dadra and Nagar Haveli and Daman and Diu', 'state_code' => 'DN', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Delhi', 'state_code' => 'DL', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Goa', 'state_code' => 'GA', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Gujarat', 'state_code' => 'GJ', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Haryana', 'state_code' => 'HR', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Himachal Pradesh', 'state_code' => 'HP', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Jammu and Kashmir', 'state_code' => 'JK', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Jharkhand', 'state_code' => 'JH', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Karnataka', 'state_code' => 'KA', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Kerala', 'state_code' => 'KL', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Ladakh', 'state_code' => 'LA', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Lakshadweep', 'state_code' => 'LD', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Madhya Pradesh', 'state_code' => 'MP', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Maharashtra', 'state_code' => 'MH', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Manipur', 'state_code' => 'MN', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Meghalaya', 'state_code' => 'ML', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Mizoram', 'state_code' => 'MZ', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Nagaland', 'state_code' => 'NL', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Odisha', 'state_code' => 'OD', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Puducherry', 'state_code' => 'PY', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Punjab', 'state_code' => 'PB', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Rajasthan', 'state_code' => 'RJ', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Sikkim', 'state_code' => 'SK', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Tamil Nadu', 'state_code' => 'TN', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Telangana', 'state_code' => 'TG', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Tripura', 'state_code' => 'TR', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Uttar Pradesh', 'state_code' => 'UP', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'Uttarakhand', 'state_code' => 'UT', 'status' => 'active'],
            ['country_id' => 1, 'name' => 'West Bengal', 'state_code' => 'WB', 'status' => 'active'],
        ];

        // Inserting states into the database
        foreach ($states as $stateData) {
            State::create($stateData);
        }
    }
}
