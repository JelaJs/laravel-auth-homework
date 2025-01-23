@extends('layout')

@section('content')
    <form action="{{ route('forecast.weather.update') }}" method="POST">
        
        @if ($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif

        @csrf

        <input type="hidden" name="_method" value="patch">
        <input type="text" name="temperature" placeholder="temperature">
        <select name="city_id">
            @foreach ($forecasts as $forecast)
                <option value="{{ $forecast->city->id }}">{{ $forecast->city->name }}</option>
            @endforeach
        </select>
        <button>Update</button>

        <ul>
            @foreach ($forecasts as $forecast)
                <li><p>{{ $forecast->city->name }} - {{ $forecast->temperature }}&deg;C</p></li>
            @endforeach
        </ul>
    </form>
@endsection