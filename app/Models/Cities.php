<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = "cities";
    protected $fillable = [
        'name', 
    ];

    public function forecasts() {
        
        return $this->hasMany(Forecasts::class, "city_id", "id");
    }
}
