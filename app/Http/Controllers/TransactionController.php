<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        $currentUser= Auth::user();
        $companies = $currentUser->company;
        $companyId = $companies->id;
        $transactionData = new Collection();
        $totalRevenue=0;
        $totalRevenueProduct=0;
        $totalRevenueService=0;

        $filteredTransactionsByServices = Transaction::whereHas('services', function ($query) use ($companyId){
            $query->where('company_id', $companyId);
        })->get();

        $filtereddTransactionsByProducts = Transaction::whereHas('products', function ($query) use ($companyId){
            $query->where('company_id', $companyId);
        })->get();


            foreach ($filteredTransactionsByServices as $transaction){

                $companyId = 0;
                $totalPrice = $transaction->total_price;
                $receipt    = $transaction->receipt;


                $totalsSplit  = $this->splitTotalTransactionPrice($receipt);
                $revenueProduct = $totalsSplit->pluck('total_product_price');
                $revenueService = $totalsSplit->pluck('total_service_price');

                $transactionData = $transactionData->push([
                    'transaction_id' => $transaction->id,
                    'totalPrice'     => $totalPrice,
                    'revenue_product'  => $revenueProduct[0],
                    'revenue_service'  => $revenueService[0]
                ]);

                $totalRevenueService+=$revenueService[0];
                $totalRevenue+=$totalPrice;
            }

            foreach ($filtereddTransactionsByProducts as $transaction){
                // echo $transaction;
                // die;
                $companyId = 0;
                $totalPrice = $transaction->total_price;
                $receipt    = $transaction->receipt;


                $totalsSplit  = $this->splitTotalTransactionPrice($receipt);
                $revenueProduct = $totalsSplit->pluck('total_product_price');
                $revenueService = $totalsSplit->pluck('total_service_price');

                $transactionData = $transactionData->push([
                    'transaction_id' => $transaction->id,
                    'totalPrice'     => $totalPrice,
                    'revenue_product'  => $revenueProduct[0],
                    'revenue_service'  => $revenueService[0]
                ]);
                $totalRevenueProduct+=$revenueProduct[0];
            }
        return view('total', compact('transactionData', 'totalRevenueService', 'totalRevenueProduct', 'totalRevenue'));
    }

    public function newAppointment(Request $request){
        $currentUser = Auth::user();
        $customer    = Customer::find($request->input('customer_id'));
        $service     = Service::find($request->input('service_id'));
        $price       = $service->companies()->where('company_id', $currentUser->company_id)->first()->pivot->price;

        $startTime = Carbon::parse($request->input('start_time'));
        $endTime  = Carbon::parse($request->input('end_time'));
        $duration = round($startTime->diffInMinutes($endTime) / 60);

        ($duration == 0) ? $duration = 1 : $duration;

        $transaction=Transaction::create([
            'customer_id'=>$customer->id,
            'receipt'=>"$service->service_name :" . $service->companies()->where('company_id', $currentUser->company_id)->first()->pivot->price . " den" . ' X ' . $duration,
            'total_price'=> $price*$duration,
        ]);

        $transaction->services()->attach($service->id, [
            'start_time'=>$startTime,
            'end_time'=> $endTime,
            'company_id' => $currentUser->company_id,
            'user_id'=> $request->input('user_id'),
            'tool_id' => $request->input('tool_id'),
            'room_id' => $request->input('room_id')
        ]);

        return redirect()->back();
    }



    public function splitTotalTransactionPrice ($string){
        $lines = explode("\n", $string);
        $totalProductPrice = 0;
        $totalServicePrice = 0;
        $totalsCollection = new Collection;

        foreach ($lines as $line){
            if(strpos($line, "Service") !== false){
               $hours = $this->extractHours($line);
               $price = $this->extractPrice($line);

               $totalServicePrice += $price * $hours;
            }elseif(strpos($line, "Product") !== false){

                $totalProductPrice += $this->extractPrice($line);
            }
        }
        $totalsCollection = $totalsCollection->push([
            'total_service_price' => $totalServicePrice,
            'total_product_price' => $totalProductPrice
        ]);

        return $totalsCollection;
    }

    public function extractPrice($line){
        preg_match('/(\d+) den/', $line, $matches);
        $price = isset($matches[1]) ? (int)$matches[1] : 0;
        return $price;
    }

    public function extractHours($line){
        preg_match('/(\d+)h/', $line, $matches);
        $hours = isset($matches[1]) ? (int)$matches[1] : 1;
        return $hours;
    }
}
