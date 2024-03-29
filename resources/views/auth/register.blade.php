@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="row mb-0">
                                <label for="badge_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Badge Number') }}</label>

                                <div class="col-md-6">
                                    <input type="hidden" name="badge_number" id=""
                                        value="{{ session('badge_number') }}">
                                    <p id="badge_number" type="text"
                                        class="form-control @error('badge_number') is-invalid @enderror" name=""
                                        disabled>
                                        @if (session('badge_number'))
                                            {{ session('badge_number') }}
                                        @else
                                            {{ __('Not set') }}
                                        @endif
                                    </p>

                                    @error('badge_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="hidden"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ session('full_name') }}">

                                    <p disabled class="form-control @error('badge_number') is-invalid @enderror">
                                        @if (session('full_name'))
                                            {{ session('full_name') }}
                                        @else
                                            {{ __('Not set') }}
                                        @endif
                                    </p>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
