<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Forecasts;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function createAndList() {

        $forecasts = Weather::all();

        return view("forecast/createAndList", [
            'forecasts' => $forecasts
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'temperature' => "required|numeric|",
            "city_id" => "required|integer|exists:cities,id"
        ]);

        $weather = Weather::where("city_id", $request->city_id)->first();
        
        $weather->update([
            "temperature" => $request->get('temperature'),
        ]);

        return back();
    }

    public function adminCreateAndList() {

        $cities = Cities::all();
        
        return view('admin/createAndList', [
            "cities" => $cities,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            "city_id" => "required|integer|exists:cities,id",
            "temperature" => "required|numeric",
            "weather_type" => ['required', 'in:sunny,snowy,rainy'],
            "probability" => "required|integer",
            "date" => "required|date"
        ]);

        Forecasts::create($request->all());

        return redirect()->back();
    }
}
