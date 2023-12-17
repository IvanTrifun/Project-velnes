<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Tool;
use App\Models\User;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(){
        $currentUser= Auth::user();
        $company = $currentUser->company;
        $services=$company->services;
        $companyId = $company->id;
        $calendarData = [];
        $serviceData = [];
        $employeeData = User::where("company_id", $companyId)->get();
        $roomData = Room::where("company_id", $currentUser->company_id)->get();
        $toolData = Tool::where("company_id", $currentUser->company_id)->get();
        $customerData = Customer::where("company_id", $currentUser->company_id)->get();

        $filteredTransactionsByServices = Transaction::whereHas('services', function ($query) use ($companyId){
            $query->where('company_id', $companyId);
        })->get();


        foreach($services as $service){
            array_push($serviceData, $service);

        }

        foreach ($filteredTransactionsByServices as $transaction){
            foreach($transaction->services as $service){
                array_push($calendarData, [
                    'company_id' => $service->pivot->company_id,
                    'title'=>$service->service_name,
                    'start'=>$service->pivot->start_time,
                    'end'=>$service->pivot->end_time,
                ]);
            }
        }
        return view("calendar", compact('calendarData', 'serviceData', 'toolData', 'roomData', 'employeeData', 'customerData'));
    }
}
