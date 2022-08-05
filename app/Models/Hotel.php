<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function holtelCountry()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
 
}
