<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        $company = $currentUser->company;
        $serviceData = [];

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $filteredServices = Service::with(['companies' => function ($query) use ($company) {
            $query->where('company_id', $company->id);
        }])->get();

        foreach($filteredServices as $service){
            if(!empty($service->companies->first()->id)){
                $company = $service->companies->first();
                $price=$company->pivot->price;

                    array_push($serviceData, [
                    'company_id' => $company->id,
                    'service_id' => $service->id,
                    'service_name' => $service->service_name,
                    'price' => $company->pivot->price
                ]);
            }
        }

        $serviceData = array_map(function ($item) {
            return (object)$item;
        }, $serviceData);

        return view('service', compact('serviceData'));
    }

    public function store(Request $request){
        $currentUser = Auth::user();
        $company = $currentUser->company;
        $service = Service::create([
            'service_name' => $request->input('service_name'),
        ]);

        $service->companies()->attach($company->id, ['price' => $request->input('price')]);

        return redirect()->route('service');
    }

    public function update(Request $request){
        $currentUser = Auth::user();
        $company = $currentUser->company;
        $service = Service::find($request->input('service_id'));

        $service->companies()->updateExistingPivot($company->id, ['price'=> $request->input('price')]);
        return redirect()->route('service');
    }

    public function destroy(Request $request){
        $service = Service::find($request->input('service_id'));
        $currentUser = Auth::user();

        $service->transactions()->wherePivot('company_id', $currentUser->company_id)->detach();

        $currentUser->company->services()->detach($service);


        return redirect()->route('service');
    }
}
