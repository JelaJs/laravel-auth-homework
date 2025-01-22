<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = "weather";
    protected $fillable = [
        "city_id",
        "temperature"
    ];

    public function city() {
        return $this->hasOne(Cities::class, "id", "city_id");
    }
}
