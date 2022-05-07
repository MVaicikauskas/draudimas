@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Consultation') }}</div>

                <div class="card-body">
                    <form method="POST" action="/consultation/store">
                        @csrf
                        @if (Auth::user()->name === 'Admin')
                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('Vartotojas') }}</label>

                                <div class="col-md-6">

                                    <select class="form-select" id="inputGroupSelect01" @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>
                                        <option selected>Pasirinkti</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        @endif

                        <div class="row mb-3">
                            <label for="topic" class="col-md-4 col-form-label text-md-end">{{ __('Tema') }}</label>

                            <div class="col-md-6">

                                <select class="form-select" id="inputGroupSelect01" @error('topic') is-invalid @enderror" name="topic" value="{{ old('topic') }}" required autocomplete="topic" autofocus>
                                    <option selected>Pasirinkti</option>
                                    <option value="1">Draudimo išmokos</option>
                                    <option value="2">Žalos atvėju</option>
                                    <option value="3">Draudimo produktai</option>
                                </select>
                                @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Konsultacijos tipas') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" id="inputGroupSelect01" @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>
                                    <option selected>Pasirinkti</option>
                                    <option value="1">Telefonu</option>
                                    <option value="2">Vaizdo skambučiu</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="additional_info" class="col-md-4 col-form-label text-md-end">{{ __('Papildoma informacija') }}</label>

                            <div class="col-md-6">

                                <textarea name="additional_info" id="additional_info" class="form-control @error('additional_info') is-invalid @enderror" value="{{ old('additional_info') }}" required autocomplete="additional_info" cols="30" rows="10"></textarea>
                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="consultation_date" class="col-md-4 col-form-label text-md-end">{{ __('Konsultacijos data') }}</label>

                            <div class="col-md-6">
                                <input id="consultation_date" type="datetime-local" class="form-control @error('consultation_date') is-invalid @enderror" name="consultation_date" value="{{ old('consultation_date') }}" required autocomplete="consultation_date" autofocus>
                                @error('consultation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                @if (Auth::user()->name != 'Admin')
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required autocomplete="user_id" autofocus>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
