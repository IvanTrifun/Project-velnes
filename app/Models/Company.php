<?php

namespace App\Models;

use App\Models\User;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'address', 'city', 'logo', 'work_number', 'postal_code', 'email'];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function services()
    {
        return $this->belongstoMany(Service::class, 'company_service')->withPivot('price');
    }

    public function products()
    {
        return $this->belongstoMany(Product::class, 'company_product')->withPivot('price', 'stock');
    }
}
