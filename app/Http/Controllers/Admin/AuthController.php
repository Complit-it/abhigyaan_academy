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
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    public function getLogin()
    {
        return view('adminPages.login');
    }
    public function loginpost(LoginRequest $request)
    {
        




        // Validate the incoming request
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('phone', 'password');
    
        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            // If authentication fails, redirect back with an error message
            return redirect()->back()->with('message', 'Invalid Login Credentials')->withInput();
        }
    
        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();
        AdminController::updateAuditTrail('Logged in');
    
        // Redirect based on the user's role
        if (Auth::user()->hasRole('user')) {
            return redirect()->intended('/');
        } else if (Auth::user()->hasRole('customer')) {
            return redirect()->intended('/');
        } else if (Auth::user()->hasRole('administrator')) {
            return redirect()->intended('/admin-home');
        } else {
            return redirect()->intended('/');
        }
    
     
        // $request->authenticate();
        // $request->session()->regenerate();
        // AdminController::updateAuditTrail('Logged in');

        // if (Auth::user()->hasRole('user')) {
        //     return redirect()->intended('/');
        // } else if (Auth::user()->hasRole('customer')) {
        //     return redirect()->intended('/');
        // } else if (Auth::user()->hasRole('administrator')) {
        //     return redirect()->intended('/admin-home');
        // } else {
        //     return redirect()->intended('/');
        // }
    }
    // public function loginpost(LoginRequest $request)
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    //     AdminController::updateAuditTrail('Logged in');

    //     if (Auth::user()->hasRole('user')) {
    //         return redirect()->intended('/');
    //     } else if (Auth::user()->hasRole('customer')) {
    //         return redirect()->intended('/');
    //     } else if (Auth::user()->hasRole('administrator')) {
    //         return redirect()->intended('/admin-home');
    //     } else {
    //         return redirect()->intended('/');
    //     }
    // }
    

   
    
    
    
    // public function loginpost(LoginRequest $request)
    // {


    //     // $validator = Validator::make($request->all(), [
    //     //     'phone' => 'required|min:10',
    //     //     'password' => 'required'
    //     // ]);
    //     // if ($validator->fails()) {
    //     //     return redirect()->back()->with('message', 'xyz')->withErrors($validator)->withInput();
    //     // }




    //     // Validate the incoming request
    //     $request->validate([
    //         'login_phone' => 'required|string',
    //         'login_password' => 'required|string',
    //     ]);
    //     $credentials = $request->only('phone', 'password');
    
    //     // Attempt to authenticate the user
    //     if (!Auth::attempt($credentials)) {
    //         // If authentication fails, redirect back with an error message
    //         return redirect()->back()->with('message', 'Invalid Login Credentials')->withInput();
    //     }
    
    //     // Regenerate the session to prevent session fixation
    //     $request->session()->regenerate();
    //     AdminController::updateAuditTrail('Logged in');
    
    //     // Redirect based on the user's role
    //     if (Auth::user()->hasRole('user')) {
    //         return redirect()->intended('/');
    //     } else if (Auth::user()->hasRole('customer')) {
    //         return redirect()->intended('/');
    //     } else if (Auth::user()->hasRole('administrator')) {
    //         return redirect()->intended('/admin-home');
    //     } else {
    //         return redirect()->intended('/');
    //     }
    // }
    






    public function studentSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'email' => 'required|min:1|email',
            'phone' => 'required|min:10',
            'fathersphone' => 'required|min:10',
            'fathersname' => 'required|min:1',
            'password' => 'required|min:1|confirmed',
            'password_confirmation'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('message', 'Wrong SignUp Credentials')->withInput();
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
        
        // DB::table('role_user')->insert([
        //     'role_id' => 4,
        //     'user_id' => $user->id,
        //     'user_type' => 'App\Models\User',
        // ]);

        Auth::login($user);
        return redirect()->back()->with('message', 'User Registered and Logged In')->withInput();
        //return redirect()->intended('/')->with('message', 'User Registered and Logged In.');
        
    //     if ($user->id > 1) {
            
    //         return redirect()->back()->with('message', 'User Registered and Logged In')->withInput();
    //     } else {
    //         return redirect()->back()->with('message', 'User Cannot be recognized.')->withInput();
    //     }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/'); // Redirect to the login page after logout
    }
}
