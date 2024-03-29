@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center px-3">
        <div class="row gap-3 p-1">
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Total Items</p>
                        <h5>{{ Auth::user()->allItems() }}</h5>
                    </div>
                </div>
            </div>
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Functional Items</p>
                        <h5>{{ Auth::user()->functionalItems() }}</h5>
                    </div>
                </div>
            </div>
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Non Functional Items</p>
                        <h5>{{ Auth::user()->nonFunctionalItems() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center px-3">
        <div class="row gap-3 p-1">
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Pending</p>
                        <h5>{{ Auth::user()->totalPending() }}</h5>
                    </div>
                </div>
            </div>
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Approved</p>
                        <h5>{{ Auth::user()->totalApproved() }}</h5>
                    </div>
                </div>
            </div>
            <div class="col card rounded">
                <div class="card-body">
                    <div class="row mb-3">
                        <p class=" fs-5 mb-1">Denied</p>
                        <h5>{{ Auth::user()->totalDenied() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
