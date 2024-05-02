<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LaratrustSeeder::class);
        $this->call(IndianStates::class);

        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'testuser1@gmail.com';
        $user->phone = '8753908744';
        $user->password = bcrypt('password');
        $user->save();

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $user->id,
            'user_type' => 'App\Models\User',
        ]);

        // Assign a role to the user
        // $user->addRole('administrator');

    }
}
