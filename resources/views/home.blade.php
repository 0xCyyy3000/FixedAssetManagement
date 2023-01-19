@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-2">
            <div class="row gap-3 p-1">
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Total Items</p>
                            <h5>{{ Auth::user()->totalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Functional Items</p>
                            <h5>{{ Auth::user()->functionalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Non Functional Items</p>
                            <h5>{{ Auth::user()->nonFunctionalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Purchased Orders</p>
                            <h5>{{ '0' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-3 p-1">
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Pending</p>
                            <h5>{{ Auth::user()->totalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Approved</p>
                            <h5>{{ Auth::user()->totalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Denied</p>
                            <h5>{{ Auth::user()->totalItems() }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col card mb-3 rounded invisible">
                    <div class="card-body">
                        <div class="row mb-3">
                            <p class=" fs-5 mb-1">Purchased Orders</p>
                            <h5>{{ Auth::user()->totalItems() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
