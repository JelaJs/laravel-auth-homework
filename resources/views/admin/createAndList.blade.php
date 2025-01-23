@extends('layout')

@section('content')

    <form action="{{route('forecast.weather.store')}}" method="POST">
        
        @if ($errors->any())
            <p>Error: {{ $errors->first() }}</p>
        @endif

        @csrf

        <select name="city_id">
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        <input type="text" name="temperature" placeholder="Temperature">
        <select name="weather_type">
            <option value="sunny">Sunny</option>
            <option value="rainy">Rainy</option>
            <option value="snowy">Snowy</option>
        </select>
        <input type="text" name="probability" placeholder="Chance of precipitation">
        <input type="date" name="date">
        <button>Create</button>
    </form>

    @foreach ($cities as $city)
        <p>{{ $city->name }}</p>

        @foreach ($city->forecasts as $forecast)
            <p>{{ $forecast->date }} : {{ $forecast->temperature }}&deg;C</p>
        @endforeach
    @endforeach
@endsection