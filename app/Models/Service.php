<?php

namespace App\Models;


use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class service extends Model
{
    use HasFactory;

    protected $fillable = ['service_name'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_service')->withPivot('price');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'service_transaction')
                    ->withPivot('room_id', 'tool_id', 'company_id', 'user_id', 'start_time', 'end_time')->withTimestamps();
    }


}
