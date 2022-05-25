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
            <form action="/newsfeed/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="submit">Pridėti Naujieną</button>
                </div>
            </form>
            @endif
            @foreach ($newsfeed as $new)
            <div class="card">
                <div class="card-header bg-success p-2 bg-opacity-50">
                    <div class="d-grid gap-2 d-md-table-row justify-content-md-start">
                        <span class="text-uppercase fw-bolder">{{ $new['name'] }}</span>
                    </div>
                    <div class="d-grid gap-2 d-md-table-row justify-content-md-end">
                        <span class="text-uppercase fw-bolder">{{ $new['created_at'] }}</span>
                    </div>
                    @if (Auth::user()->role === 'Admin')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/newsfeed/update/{{ $new->id }}" class="btn btn-warning me-md-2" type="button">Atnaujinti</a>
                        <form class="d-inline" action="/newsfeed/delete/{{$new->id}}" method="post">
                            <button type="submit"class="btn btn-danger me-md-2" onclick="return confirm('Ar tikrai norite ištrinti ši įrašą?')" name="delete">Ištrinti</button>
                            {{ csrf_field()}}
                        </form>

                    </div>
                    @endif
                </div>


                <div class="card-body bg-success p-2 text-white bg-opacity-75">
                        <div class="" role="alert">
                            {{ $new['info'] }}
                        </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
