<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $fillable = ['rep_id', 'zip_code', 'created_at', 'updated_at'];

    public function rep()
    {
        return $this->hasOne('App\Models\SalesRep','id','rep_id');
    }
}
