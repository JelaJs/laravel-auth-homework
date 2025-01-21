@extends('layout')

@section('content')
    <h1 style="text-align: center;">City Temperatures</h1>
    <table>
        <thead>
            <tr>
                <th>City</th>
                <th>Temperature</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forecasts as $forecast)
                <tr>
                    <td>{{ $forecast->city->name }}</td>
                    <td>{{ $forecast->temperature }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection