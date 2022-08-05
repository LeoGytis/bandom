<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;

class Country extends Model
{
    use HasFactory;

    public function countryHotels()
   {
       return $this->hasMany('App\Models\Hotel', 'hotel_id', 'id');
   }

   public function hotelCount()
   {
       return $this->hasMany('App\Models\Hotel', 'hotel_id', 'id');
   }

   public function hotels()
    {
        return $this->hasMany(Hotel::class, 'country_id', 'id');
    }

}
