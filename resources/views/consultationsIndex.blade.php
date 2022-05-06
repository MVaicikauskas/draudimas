@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->name === 'Admin')
            <form action="/consultation/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2 " type="submit">Add New Consultation</button>
                </div>
            </form>
            @endif
            {{-- @foreach ($consultations as $consultation)
            <div class="card">
                <div class="card-header bg-success p-2 bg-opacity-50">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <span class="text-uppercase fw-bolder">{{ $consultation['name'] }}</span>
                    </div>
                    @if (Auth::user()->name === 'Admin')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/update.new/{{ $new->id }}" class="btn btn-warning me-md-2" type="button">Update</a>
                        <form action="/delete.new/{{$new->id}}" method="post">
                            <button type="submit"class="btn btn-danger me-md-2" name="delete">Delete</button>
                            {{ csrf_field()}}
                        </form>

                    </div>
                    @endif
                </div>


                <div class="card-body bg-success p-2 text-white bg-opacity-75">
                        <div class="" role="alert">
                            {{ $consultation['info'] }}
                        </div>
                </div>
            </div>
            @endforeach --}}
            <table class="table table-success table-striped">
                <thead class="align-middle">
                    <th class="align-middle">Vardas Pavardė</th>
                    <th class="align-middle">Telefonas</th>
                    <th class="align-middle">El.paštas</th>
                    <th class="align-middle">Tema</th>
                    <th class="align-middle">Konsultacijos Tipas</th>
                    <th class="align-middle">Papildoma Informacija</th>
                    <th class="align-middle">Konsultacijos data</th>
                    <th class="align-middle">Veiksmai</th>
                </thead>
                <tbody>
                    @foreach ($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->name }}</td>
                        <td>{{ $consultation->phone }}</td>
                        <td>{{ $consultation->email }}</td>
                        <td>{{ $consultation->topic }}</td>
                        <td>{{ $consultation->type }}</td>
                        <td>{{ $consultation->info }}</td>
                        <td>{{ $consultation->date }}</td>
                        <td><div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/consultation/update/{{ $consultation->id }}" class="btn btn-warning me-md-2" type="button">Tvarkyti</a>
                            <form action="/consultation/delete/{{$consultation->id}}" method="post">
                                <button type="submit"class="btn btn-success me-md-2" name="delete">Įvykdyta</button>
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
