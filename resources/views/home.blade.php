@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->name === 'Admin')
            <form action="/newsfeed/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="submit">Add New Topic</button>
                </div>
            </form>
            @endif
            @foreach ($newsfeed as $new)
            <div class="card">
                <div class="card-header bg-success p-2 bg-opacity-50">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <span class="text-uppercase fw-bolder">{{ $new['name'] }}</span>
                    </div>
                    @if (Auth::user()->name === 'Admin')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/newsfeed/update/{{ $new->id }}" class="btn btn-warning me-md-2" type="button">Update</a>
                        <form action="/newsfeed/delete/{{$new->id}}" method="post">
                            <button type="submit"class="btn btn-danger me-md-2" name="delete">Delete</button>
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
