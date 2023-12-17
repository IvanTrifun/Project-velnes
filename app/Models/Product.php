<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'category'];
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_product')->withPivot('price', 'stock');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'product_transaction')->withPivot('company_id');
    }

}
