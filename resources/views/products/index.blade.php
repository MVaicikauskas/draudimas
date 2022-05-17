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
            <form action="/products/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="submit">Pridėti Produktą</button>
                </div>
            </form>
            @endif
            @foreach ($products as $product)
            <div class="card">
                <div class="card-header bg-success p-2 bg-opacity-50">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <span class="text-uppercase fw-bolder">{{ $product['name'] }}</span>
                    </div>
                    @if (Auth::user()->role === 'Admin')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/products/update/{{ $product->id }}" class="btn btn-warning me-md-2" type="button">Atnaujinti</a>
                        <form action="/products/delete/{{$product->id}}" method="post">
                            <button type="submit"class="btn btn-danger me-md-2" onclick="return confirm('Ar tikrai norite ištrinti šį produktą?')" name="delete">Ištrinti</button>
                            {{ csrf_field()}}
                        </form>

                    </div>
                    @endif
                </div>


                <div class="card-body bg-success p-2 text-white bg-opacity-75">
                        <div class="" role="alert">
                            {{ $product['description'] }}
                        </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
