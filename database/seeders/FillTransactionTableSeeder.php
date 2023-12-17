<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FillTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            $services = $transaction->services;
            $products = $transaction->products;

            $totalPrice = 0;
            $recept = '';
            $duration = 0;

            foreach ($services as $service) {
                $starTime = Carbon::parse($service->pivot->start_time);
                $endTime = Carbon::parse($service->pivot->end_time);
                $duration = round($starTime->diffInMinutes($endTime) / 60);

                ($duration == 0) ? $duration = 1 : $duration;

                $companyId = $service->pivot->company_id;
                $company = Company::find($companyId);

                $pivotCompanyService = $company
                    ->services()
                    ->where('service_id', $service->id)
                    ->first()
                    ->pivot;

                $totalPrice += $pivotCompanyService->price * $duration;

                $recept .=
                    'Service: ' .
                    $service->service_name .
                    ' => ' .
                    $pivotCompanyService->price .
                    ' den. x ' . $duration . 'h' . "\n";
            }

            foreach ($products as $product) {

                if($product->pivot){
                    $companyId = $product->pivot->company_id;
                    $company = Company::find($companyId);

                    $pivotCompanyProduct = $product
                            ->companies()
                            ->where('company_id', $company->id)
                            ->first()
                            ->pivot;


                    $totalPrice += $pivotCompanyProduct->price;

                    $recept .=
                    ' Product: ' .
                    $product->product_name .
                    ' => ' .
                    $pivotCompanyProduct->price .
                    ' den.' . "\n";
                }
            }

            $transaction->receipt = $recept;
            $transaction->total_price = $totalPrice;
            $transaction->save();
        }
    }

}
