<?php

namespace App\Http;

class ForecastHelper {

    const WEATHER_TYPE = [
        "sunny" => "sun",
        "rainy" => "cloud-rain",
        "snowy" => "snowflake"
    ];

    public static function getColorByTemperature($temperature) {

        if($temperature <= 0) {
            $color = "lighblue";
        }
        else if($temperature > 0 && $temperature <= 15) {
            $color = "blue";
        }
        else if($temperature > 15 && $temperature <= 25) {
            $color = "green";
        } 
        else {
            $color = "red";
        }

        return $color;
    }

    public static function weatherTypeIcon($weather) {

       $icon = self::WEATHER_TYPE[$weather];

        return $icon;
    }
}

