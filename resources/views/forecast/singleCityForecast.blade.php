@extends("layout")

@section('content')

@if ($error !== null)
    <p>{{ $error }}</p>

@else
    <h1 style="text-align: center;">{{$city}}</h1>
    <table>
        <thead>
            <tr>
                <th>Temperature</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forecast as $temperature)
                <tr>
                    <td>{{ $temperature }}&deg;C</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection