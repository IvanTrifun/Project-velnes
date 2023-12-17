<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Tool;
use App\Models\User;
use App\Models\Company;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignServicesToTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();

        foreach($transactions as $transaction){
            $companies = Company::all();
            $randomCompany  = $companies->random();
            $services = Service::all();

            $tools = Tool::all();
            $rooms = Room::all();

            foreach($services as $service){
                $randomDateTime = $this->randomTime();
                $randomUser =  User::inRandomOrder()
                ->where('company_id', $randomCompany->id)
                ->limit(1)
                ->first();
                $randomTool = $tools->random();
                $randomRoom = $rooms->random();
                $service->transactions()->attach($transaction->id, [
                    'tool_id'    => $randomTool->id,
                    'room_id'    => $randomRoom->id,
                    'company_id' => $randomCompany->id,
                    'user_id'    => $randomUser->id,
                    'start_time' => $randomDateTime['startTime'],
                    'end_time'   => $randomDateTime['endTime']
                ]);
            }
        }
    }

    public function randomTime()
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $randomDate = Carbon::create(rand(2022, 2023), rand(1, 12), rand(1, 28));

        $startTimeConstraint = Carbon::createFromTime(9, 0, 0); // 9:00 AM
        $endTimeConstraint = Carbon::createFromTime(17, 0, 0); // 5:00 PM

        $startTime = $randomDate->copy()->addHours(rand($startTimeConstraint->hour, $endTimeConstraint->hour))
                                    ->addMinutes(rand(0, 59))
                                    ->addSeconds(rand(0, 59));

        $endTime = $randomDate->copy()->addHours(rand($startTime->hour, $endTimeConstraint->hour))
                                ->addMinutes(rand(0, 59))
                                ->addSeconds(rand(0, 59));

        return array('startTime'=> $startTime, 'endTime' => $endTime);
    }
}
