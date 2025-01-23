<?php

use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Cities;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome")->name("home");

Route::get("/forecast", [ForecastController::class, 'allForecasts'])->middleware("auth")->name("forecast.all");

Route::get("/forecast/{city:name}", [ForecastController::class, "signleCityForecast"])->name("forecast.single");

Route::middleware(["auth", AdminMiddleware::class])->name("forecast.")->prefix('/admin')->group(function () {
    Route::get('/forecast', [ForecastController::class, "index"])->name('list');
    Route::view('/forecast/create', 'admin/createForecast')->name('create');
    Route::post('/forecast/store', [ForecastController::class,'store'])->name('store');
    Route::get('/forecast/edit/{city}', [ForecastController::class,'edit'])->name('edit');
    Route::patch('/forecast/update/{city}', [ForecastController::class,'update'])->name('update');
    Route::delete('/forecast/destroy/{city}', [ForecastController::class, 'destroy'])->name('destroy');
    Route::get('/weather', [WeatherController::class, 'createAndList']);
    Route::patch('/weather', [WeatherController::class,'update'])->name('weather.update');
    Route::get('/weather/forecasts', [WeatherController::class,'adminCreateAndList']);
    Route::post('/weather/forecasts', [WeatherController::class, 'store'])->name('weather.store');
});



///////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
