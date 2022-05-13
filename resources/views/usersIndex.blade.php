@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
            @endif
            @if (Auth::user()->role === 'Admin')
            <form action="/users/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2 " type="submit">Pridėti Naują Vartotoją</button>
                </div>
            </form>
            @endif

            <table class="table table-success table-striped">
                <thead class="align-middle">
                    <th class="align-middle">Vardas Pavardė<i class="fa-solid fa-arrow-down-a-z"></i></th>
                    <th class="align-middle">Telefonas</th>
                    <th class="align-middle">El.paštas</th>
                    <th class="align-middle">Registracijos Data</th>
                    <th class="align-middle">Veiksmai</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td><div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/users/update/{{ $user->id }}" class="btn btn-warning me-md-2" type="button">Tvarkyti Duomenis</a>
                            <a href="/users/passwordUpdate/{{ $user->id }}" class="btn btn-warning me-md-2" type="button">Keisti Slaptažodį</a>

                            <form action="/users/delete/{{$user->id}}" method="post">
                                <button type="submit"class="btn btn-danger me-md-2" onclick="return confirm('Ar tikrai norite ištrinti vartotoją {{ $user->name }}?')" name="delete">Ištrinti Vartotoją</button>
                                {{ csrf_field()}}
                            </form>
                        </div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
