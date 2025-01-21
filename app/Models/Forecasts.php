<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecasts extends Model
{
    
    protected $table = "forecasts";

    protected $fillable = [
        "city_id",
        "temperature",
        "date"
    ];

    public function city() {
         
        return $this->hasOne(Cities::class, 'id', 'city_id');  
    }
}
