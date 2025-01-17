@extends('layout')

@section('content')
    <form action="{{ route('forecast.store') }}" method="POST">

        @if($errors->any())
            <p>Error: {{ $errors->first() }}</p>
        @endif

        @csrf
        <input type="text" name="city" placeholder="Add city">
        <input type="text" name="temperature" placeholder="Add temperature">
        <button type="submit">Create</button>
    </form>
@endsection