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
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->temperature }}&deg;C</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection