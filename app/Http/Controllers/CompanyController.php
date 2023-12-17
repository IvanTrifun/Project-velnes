<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        $company=$currentUser->company;
        return view("companyInfo",compact("company"));
    }

    public function update(Request $request){
        $currentUser = Auth::user();
        $company=$currentUser->company;
        $company->update([
            "company_name"=> $request->input("company_name"),
            "work_number"=> $request->input("work_number"),
            "email"=> $request->input("email"),
            "city"=> $request->input("city"),
            "address"=> $request->input("address"),
            "logo"=> $request->input("logo"),
            "postal_code"=> $request->input("postal_code"),
        ]);
        return redirect()->back()->with("success","company update succesfully");
    }

}
