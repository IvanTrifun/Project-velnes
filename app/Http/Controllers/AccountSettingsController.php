<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        return view("accountSettings", compact("currentUser"));
    }

    public function generalSettings(){
        return view("generalSettings");
    }

    public function edit(){
        $currentUser = Auth::user();
        return view('accountSettings', compact('currentUser'));
    }
    public function update(Request $request){
       $currentUser = Auth::user();

       if($request->input("new_password") == $request->input("repeat_password")){

            $currentUser->update([
                "full_name"=>$request->input("full_name"),
                "email"=>$request->input("email"),
                "password"=> Hash::make($request->input("new_password")),
                "profile_picture" => $request->input("profile_picture")
            ]);

            return redirect()->route("accountSettings")->with('success', 'Account updated succesfully');
       }else{

            return redirect()->route('accountSettings')->with('error', 'New password doesnt match confirm password!!');
       }
    }

    public function destroy(Request $request){
        $currentUser = Auth::user();
        // dd(Hash::make($request->input("password")));
        if(Hash::check($request->input("password"), $currentUser->password)){
        $currentUser->delete();
        return redirect()->route('login')->with('success', 'Account deleted');
        }else{
            echo 'wrong password pls try again';
            return view("generalSettings")->with('error', 'wrong password');
        }

    }
}
