<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;
class RepUserListing extends Model
{
    protected $fillable = ['company_name','rep_name','rep_id','date','badge_id','lead_name','email','phone','street','city','state','zipcode','country'];

    public function rep()
    {
        return $this->hasOne('App\Models\SalesRep','id','rep_id');
    }

    public function getDateAttribute($value)
    {
    	$IST = new DateTime($value, new DateTimeZone('UTC'));
        $IST->setTimezone(new DateTimeZone('PST'));
        return $IST->format('d-m-y h:i:s A');
    }
}
