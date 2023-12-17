<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  HasFactory;
    protected $fillable = ['full_name', 'email', 'password', 'company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
