<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Transaction;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'contact_number', 'email' ,  'company_id','group_id'];
    public function transactions(){
        return  $this->hasMany(Transaction::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'events')->withPivot('start_time', 'end_time');
    }

}
