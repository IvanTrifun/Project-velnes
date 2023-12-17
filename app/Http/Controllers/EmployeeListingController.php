<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeListingController extends Controller
{
    public function index(){
        $currentAuthUser = Auth::user();
        $companyId= $currentAuthUser->company_id;
        $coworkers = User::where("company_id", $companyId)->get();
        $employees= new Collection;

        foreach( $coworkers as $coworker ){
            if($coworker->roles->first()->id == '3'){
                $employees->push([
                    'employee_id' => $coworker->id,
                    'position'=> $coworker->roles->first()->role_type,
                    'full_name'=>$coworker->full_name,
                    'profile_picture'=>$coworker->profile_picture
                ]);
            }
        }
        return view('employeeListing', compact ('employees'));
    }
}
