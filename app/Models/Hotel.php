<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function hotelCountry()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'hotel_id', 'id');
    }
}
