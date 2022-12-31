@extends('layouts.layout')
@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <a href="{{ route('itemshow') }}" class="btn btn-primary">Item List</a>
                        |
                        <a href="{{ route('itemlist') }}" class="btn btn-primary">Item Show Item</a>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
