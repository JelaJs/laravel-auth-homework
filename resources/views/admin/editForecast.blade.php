@extends('layout')

@section('content')
    <form action="{{ route('forecast.update', $city->id) }}" method="POST">
       
        @if($errors->any())
            <p>Error: {{ $errors->first() }}</p>
         @endif

        @csrf
        <input type="hidden" name="_method" value="patch">
        <input type="text" name="city" value="{{ $city->name }}">
        <input type="text" name="temperature" value="{{ $city->temperature }}">
        <button type="submit">Edit</button>
    </form>
@endsection