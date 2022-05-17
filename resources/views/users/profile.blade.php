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
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Vardas Pavardė</div>
                    {{$users->name}}
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">El. paštas</div>
                    {{$users->email}}
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Telefono numeris</div>
                    {{$users->phone_number}}
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Registracijos data</div>
                      {{$users->created_at}}
                    </div>
                  </li>
            </ul>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/users/update/{{ $users->id }}" class="btn btn-warning me-md-2" type="button">Tvarkyti Duomenis</a>
                <a href="/users/passwordUpdate/{{ $users->id }}" class="btn btn-warning me-md-2" type="button">Keisti Slaptažodį</a>

                <form action="/users/delete/{{$users->id}}" method="post">
                    <button type="submit"class="btn btn-danger me-md-2" onclick="return confirm('Ar tikrai norite ištrinti vartotoją {{ $users->name }}?')" name="delete">Ištrinti Vartotoją</button>
                    {{ csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
