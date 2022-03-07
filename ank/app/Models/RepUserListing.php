<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepUserListing extends Model
{
    protected $fillable = ['user_name','rep_name','rep_id','date'];

    public function rep()
    {
        return $this->hasOne('App\Models\SalesRep','id','rep_id');
    }
}
