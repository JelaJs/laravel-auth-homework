@extends("layout")

@section('content')


    <h1 style="text-align: center;">{{$city->name}}</h1>
    <table>
        <thead>
            <tr>
                <th>Temperature</th>
            </tr>
        </thead>
        <tbody>
                
                    @foreach ($city->forecasts as $forecast)
                    <tr>
                        <td>{{ $forecast->temperature }}&deg;C</td>
                    </tr>
                    @endforeach
                
        </tbody>
    </table>

@endsection