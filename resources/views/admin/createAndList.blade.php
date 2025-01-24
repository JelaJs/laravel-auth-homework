@extends('admin.layout')

@section('content')

    <form action="{{route('forecast.weather.store')}}" method="POST">

        @if ($errors->any())
            <p>Error: {{ $errors->first() }}</p>
        @endif

        @csrf

        <div class="mb-3">
            <select class="form-select" name="city_id" aria-label="Select city">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Temperature</label>
            <input type="text" name="temperature" class="form-control" placeholder="temperature">
        </div>
        <select class="form-select" name="weather_type" aria-label="Select city">
            <option value="sunny">Sunny</option>
            <option value="rainy">Rainy</option>
            <option value="snowy">Snowy</option>
        </select>
        <div class="mb-3">
            <label class="form-label">Probability</label>
            <input type="text" name="probability" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <div class="d-flex flex-wrap" style="gap: 10px;">
        @foreach ($cities as $city)
        
        <div>
            <p>{{ $city->name }}</p>

            <ul class="list-group mb-4">
                @foreach ($city->forecasts as $forecast)

                    @php
                        $color = App\Http\ForecastHelper::getColorByTemperature($forecast->temperature);
                        $icon = App\Http\ForecastHelper::weatherTypeIcon($forecast->weather_type);
                    @endphp

                    <li class="list-group-item">
                        <p>
                            <span>{{ $forecast->date }}</span> : <span><i class="fa-solid fa-{{$icon}}"></i></span> <span style="color: {{ $color }}">{{ $forecast->temperature }}&deg;C</span >
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>

    @endforeach
    </div>
    

    
@endsection