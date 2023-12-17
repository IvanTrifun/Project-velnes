<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $currentUser= Auth::user();
        $coworkers= User::where("company_id", $currentUser->company_id)->get();
        $coworkersData = new Collection;
        $data = [];

        foreach ($coworkers as $coworker){
            $data = [
                'user_id' => $coworker->id,
                'user_name' => $coworker->full_name,
                'email' => $coworker->email,
                'profile_picture' =>$coworker->profile_picture,
            ];
            foreach ($coworker->roles as $role){
                $data['role_type'][] = $role->role_type;
            }
            $coworkersData->push($data);
        }
        // dd(json_encode($coworkersData));
        return view("userAccounts" ,compact("coworkersData"));

    }

    public function store(Request $request){
        $currentUser= Auth::user();

        if($request->input("password") == $request->input("repeat_password") && $currentUser){
            $coworker= User::create([
                'full_name'=>$request->input('full_name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make($request->input('password')),
                'company_id' => $currentUser->company_id,
                'profile_picture'=>$request->input('profile_picture'),

            ]);
            $coworker->roles()->attach(3);
        }
        return redirect()->route('userAccounts')->with('success','account created');
    }

    public function update(Request $request){
        $coworker = User::find($request->input('user_id'));

        return $this->ifPasswordComfirmedUpdate($request, $coworker);
     }

     public function ifPasswordComfirmedUpdate(Request $request, $coworker){
        if($request->input("new_password") == $request->input("repeat_password")){

            $this->updateCoworker($request, $coworker);
            $this->ifRolesSelectedAttach($request, $coworker);

            return redirect()->route("userAccounts")->with('success', 'Account updated succesfully');
        }

        return redirect()->route('userAccounts')->with('error', 'New password doesnt match confirm password!!');
     }

     public function ifRolesSelectedAttach(Request $request, $coworker){
        if($request->has('selectedRoles')){
            $selectedRoles = $request->input('selectedRoles');
            $existingRoles = $coworker->roles()->pluck("id")->toArray();

            foreach($existingRoles as $role){
                $coworker->roles()->detach($role);
            }

            foreach($selectedRoles as $role){
                $coworker->roles()->attach($role);
            }
        }
     }

     public function updateCoworker(Request $request, $coworker){
        $coworker->update([
            "full_name"=>$request->input("full_name"),
            "email"=>$request->input("email"),
            "password"=> Hash::make($request->input("new_password")),
            'profile_picture'=>$request->input('profile_picture')
        ]);
     }

     public function destroy(Request $request){
        $coworker = User::find($request->input("user_id"));
        $coworker->delete();
        return redirect()->route('userAccounts')->with('success', 'Tool deleted');

    }
}

