<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function home(){
        $currentUser = Auth::user();

        $company = $currentUser->company;
        $companyId = $company->id;

        $users=User::where("company_id", $companyId)->get();

        $pivotData = new Collection;

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $filteredServices = Service::with(['transactions' => function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        }])->get();

        foreach ($filteredServices as $service) {
            foreach ($service->transactions as $transaction){
                $user = User::find($transaction->pivot->user_id);

                if (!$user) {
                    $transaction->services()->detach($transaction->pivot->service_id);
                }
                else{
                    $inputStartTime = $transaction->pivot->start_time;
                    $inputEndTime = $transaction->pivot->end_time;
                    $carbonStartTime = Carbon::parse($inputStartTime);
                    $carbonEndTime = Carbon::parse($inputEndTime);
                    $start_hours_minutes = $carbonStartTime->format('H:i');
                    $end_hours_minutes = $carbonEndTime->format('H:i');
                    $pivotData->push([
                        'transaction_id' => $transaction->pivot->transaction_id,
                        'start_time' => $transaction->pivot->start_time,
                        'end_time' => $transaction->pivot->end_time,
                        'start_hours_minutes' => $start_hours_minutes,
                        'end_hours_minutes' => $end_hours_minutes,
                        'user_full_name' => $user->full_name,
                        'img_src' => $user->profile_picture,
                        'service_name' => $service->service_name
                    ]);
                }
            }
        }

        $pivotData = $pivotData->unique();

        return view("home" ,compact('pivotData', 'users'));
    }


}
