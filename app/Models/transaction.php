<?php

namespace App\Models;


use App\Models\Room;
use App\Models\Tool;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'receipt', 'total_price'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_transaction')->withPivot('company_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_transaction')
                    ->withPivot('room_id', 'tool_id', 'company_id', 'user_id', 'start_time', 'end_time')->withTimestamps();
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function tool()
    {
        return $this->hasOne(Tool::class, 'tool_id');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'room_id');
    }
}
