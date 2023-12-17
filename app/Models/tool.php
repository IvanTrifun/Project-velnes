<?php

namespace App\Models;

// use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = ['tool_name', 'company_id'];
}
