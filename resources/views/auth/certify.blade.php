@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center">{{ __('Register') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.certify') }}">
                            @csrf
                            <div class="row mb-3 m-auto w-100">
                                <label for="badge_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Badge number') }}</label>

                                <div class="col-md-6">
                                    <input id="badge_number" type="text"
                                        class="form-control @error('badge_number') is-invalid @enderror" name="badge_number"
                                        value="{{ old('badge_number') }}" required autocomplete="name" autofocus
                                        placeholder="e.g. x123">

                                    @error('badge_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0 ">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Proceed') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
