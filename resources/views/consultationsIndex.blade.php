@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->name === 'Admin')
            <form action="/consultation/create" method="get">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2 " type="submit">Pridėti Naują Konsultaciją</button>
                </div>
            </form>
            @endif

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
                            @if (Auth::user()->name === 'Admin')
                            <form action="/consultation/delete/{{$consultation->id}}" method="post">
                                <button type="submit"class="btn btn-success me-md-2" onclick="return confirm('Konsultacija su klientu {{ $consultation->name }} įvykdyta?')" name="delete">Įvykdyta</button>
                                {{ csrf_field()}}
                            </form>
                            @elseif (Auth::user()->name != 'Admin')
                            <form action="/consultation/delete/{{$consultation->id}}" method="post">
                                <button type="submit"class="btn btn-danger me-md-2" onclick="return confirm('Ar tikrai norite atšaukti šia konsultaciją?')" name="delete">Atšaukti</button>
                                {{ csrf_field()}}
                            </form>
                            @endif

                        </div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
