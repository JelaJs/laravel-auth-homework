<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ForecastController extends Controller
{
    public function index() {
        $cities = Cities::all();

        return view("admin/list", [
            "cities" => $cities
        ]);
    }

    public function store(Request $request) { 
        request()->validate([ 
            'city' => 'required|string|min:3|max:32|unique:cities,name',
            'temperature' => 'required|numeric'
        ]);

        Cities::create([
            'name' => $request->get('city'),
            'temperature' => $request->get('temperature'),
        ]);

        return redirect()->route('forecast.list');
    }

    public function edit(Cities $city) {
        return view('admin/editForecast', [
            'city'=> $city,
        ]);
    }

    public function update(Request $request, Cities $city) {
        request()->validate([
            'city' => [
            'required',
            'string',
            'min:3',
            'max:32',
            Rule::unique('cities', 'name')->ignore($city->id),
        ],
            'temperature' => "required|numeric"
        ]);

        $city->update([
            "name" => $request->get("city"),
            "temperature" => $request->get("temperature"),
        ]);

        return redirect()->route("forecast.list");
    }

    public function destroy(Cities $city) {
        $city->delete();

        return redirect()->back();
    }

    public function signleCityForecast($city) {
        $cities = [
            "Beograd" => [23, 22, 25, 25, 21],
            "Novi Sad" => [21, 22, 23, 32, 15],
            "Zrenjanin" => [21, 21, 23, 23, 22]
        ];

        $lowerCaseCities = array_change_key_case($cities, CASE_LOWER);

        $error = null;
        $forecast = "";

        $city = strtolower($city);

        if(!array_key_exists($city, $lowerCaseCities)) {
            $error = "There is no city with this name.";
        } else {
            $forecast = $lowerCaseCities[$city];
        }

       return view("forecast/singleCityForecast", [
            "city" => $city,
            "forecast" => $forecast,
            "error" => $error
        ]);
    }
}
