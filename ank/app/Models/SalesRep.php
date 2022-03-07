<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRep extends Model
{
    protected $fillable = ['first_name', 'last_name', 'full_name', 'color', 'created_at', 'updated_at'];
}
