<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        $currentUser = Auth::user();

        $companyCurrentUser = $currentUser->company;
        $companyId = $companyCurrentUser->id;
        $filteredCustomers = Customer::where("company_id", $companyId)->get();

        return view("customer", compact("filteredCustomers"));
    }

    public function store(Request $request){
        $currentUser = Auth::user();

        $customer= Customer::create([
            "full_name" => $request->input('full_name'),
            "email" => $request->input('email'),
            "contact_number" => $request->input("contact_number"),
            "company_id" => $currentUser->company_id,
            "group_id"=> (int)$request->input('group_id')

        ]);

        return redirect()->route("customer")->with("success","success !");
    }

    public function update(Request $request){
        $currentUser = Auth::user();
        $customer = Customer::find($request->input('customer_id'));

        if(!$request->input('group_id')){
            return response()->json(['error' => 'Group not found']);
        }

        $customer->update([
            "full_name" => $request->input('full_name'),
            "email" => $request->input('email'),
            "contact_number" => $request->input("contact_number"),
            "company_id" => $currentUser->company_id,
            "group_id"=> (int)$request->input('group_id')
        ]);

        return redirect()->route("customer")->with("success","success !");
    }

    public function destroy(Request $request){
        $customer = Customer::find($request->input('customer_id'));

        $customer->delete();

        return redirect()->route("customer")->with("success","success !");
    }
}
