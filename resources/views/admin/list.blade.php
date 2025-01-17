@extends("layout")

@section("content")
    <h1 style="text-align: center;">City Temperatures</h1>
    <a href="{{ route('forecast.create') }}">Create</a>
    <table>
        <thead>
            <tr>
                <th>City</th>
                <th>Temperature</th>
                <th>Create</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->temperature }}&deg;C</td>
                    <td><a href="{{ route('forecast.edit', $city->id) }}">Edit</a></td>
                    <td><form action="{{ route('forecast.destroy', $city->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection