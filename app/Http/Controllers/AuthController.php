<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {

        $company = new Company();

        $company->company_name = $request->company_name;
        $company->work_number = $request->work_number;
        $company->address = $request->address;
        $company->city = $request->city;
        $company->postal_code = $request->postal_code;
        $company->email = $request->company_email;
        $company->logo = ($request->logo) ? $request->logo : null;

        $company->save();

        $user = new User();

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->company_id = $company->id;
        $user->profile_picture = $request->profile_picture;

        $role = Role::find(2);


        $user->save();

        $trueUser = User::where('email', $user->email)->first();

        $role = Role::find(2);

        if($role){
            $trueUser->roles()->attach($role->id);
        }

        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            return redirect('/')->with('success', 'Login Success');
        }

        return back()->with('error', 'Error Email or Password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
