@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-5">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body h-100 py-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="badge_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Badge number') }}</label>

                                <div class="col-md-6">
                                    <input id="badge_number" type="text"
                                        class="form-control @error('badge_number') is-invalid @enderror" name="badge_number"
                                        value="{{ old('badge_number') }}" required autofocus>

                                    @error('badge_number')
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
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

{{-- <div class="container ">
    <div class="row m-5">
   
            <div class="card m-5 ">
                <div class="p-5 m-5"> 
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="badge_number"
                        class="col-md-4 col-form-label text-md-end">{{ __('Badge number') }}</label>

                    <div class="col-md-6">
                        <input id="badge_number" type="text"
                            class="form-control @error('badge_number') is-invalid @enderror" name="badge_number"
                            value="{{ old('badge_number') }}" required autofocus>

                        @error('badge_number')
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
                            required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>

</div> --}}

<section class="vh-100" style="background-color: #FFFF;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem; background-color: #FFFF; ">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block pt-3">
                <img class="w-100" src="{{ asset('imgs/BFP Logo.png') }}" alt="bfp.logo">
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                
                <div class="card-body p-lg-5 text-black">
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Fixed Asset</span>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                  
                    <div class="form-outline mb-2">
                        <div class="   ">
                            <label class="form-label" for="form2Example27">{{ __('Badge number') }}</label>   
                            <input id="badge_number" type="text"
                                class="form-control @error('badge_number') is-invalid @enderror" name="badge_number"
                                value="{{ old('badge_number') }}" required autofocus>
                            @error('badge_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                       
                    </div>

                    <div class="mb-3 ">
                        <div class="">
                            <label for="password"
                            class=" col-form-label text-md-end">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                    </div>
  
                    <div class="pt-2 ">
                        <button type="submit" class="btn btn-primary ms-auto">
                            {{ __('Login') }}
                        </button>

                        <div class="float-end">
                            @guest
        
                                @if (Route::has('register.certify-create'))
                                        <a class="btn btn-primary ms-auto "
                                            href="{{ route('register.certify-create') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
        
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                            @endguest
                        </div>
                           
                    </div>

                         <!-- Authentication Links -->
                        

                  </form>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
