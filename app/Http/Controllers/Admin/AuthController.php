<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserProfile;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('adminPages.login');
    }

    public function loginpost(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        AdminController::updateAuditTrail('Logged in');

        if (Auth::user()->hasRole('user')) {
            return redirect()->intended('/');
        } else if (Auth::user()->hasRole('customer')) {
            return redirect()->intended('/');
        } else if (Auth::user()->hasRole('administrator')) {
            return redirect()->intended('/admin-home');
        } else {
            return redirect()->intended('/dashboard');
        }
    }

    public function studentSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'email' => 'required|min:1',
            'phone' => 'required|min:1',
            'fathersphone' => 'required|min:1',
            'fathersname' => 'required|min:1',
            'password' => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $checkDuplicatePhone = User::where('phone', '=', $request->phone)->first();
        if ($checkDuplicatePhone) {
            return redirect()->back()->with('message', 'Phone Already Registered used. Use login instead.')->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        $userProfile = new UserProfile();
        $userProfile->userId = $user->id;
        $userProfile->fathersname = $request->fathersname;
        $userProfile->fathersphone = $request->fathersphone;
        $userProfile->save();

        DB::table('role_user')->insert([
            'role_id' => '4',
            'user_id' => $user->id,
            'user_type' => 'App\Models\User',
        ]);

        if ($user->id > 1) {
            return redirect()->back()->with('message', 'User Registered. Login to Continue.')->withInput();
        } else {
            return redirect()->back()->with('message', 'User Cannot be recognized.')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/'); // Redirect to the login page after logout
    }
}
