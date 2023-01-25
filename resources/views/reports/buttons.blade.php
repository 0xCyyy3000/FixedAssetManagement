@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container p-0 bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 bg-white shadow">
                    <p class="text-start fs-3 fw-bolder">Inventroy Form</p>
                </div>
                <div class="row">
                    <h3 class="text-center fs-4">Item Description</h3>
                </div>
                <div class="d-flex p-3 justify-content-end gap-2">
                    <a href="{{ route('view')}}"class="btn btn-primary btn-sm float-end mx-1">Download PDF</a>
                    <a href="{{ route('viewonly')}}"class="btn btn-primary btn-sm float-end mx-1" target="_blank">View PDF</a>
                </div>
            </div>
        </div>
    </div>
@endsection
