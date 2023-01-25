@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 border-bottom border-3 mb-3">
                    <h5 class="col pt-2">Edit Profile</h5>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="text-center w-80 m-auto mb-3">
                        <img class="my-bg-secondary rounded-4" id="preview-thumbnail"
                            src="{{ $user->photo ? asset('photo/' . $user->photo) : asset('imgs/avatar.png') }}"
                            alt="" width="200" height="200">
                    </div>
                    <div class="text-center">
                        <input type="file" class="form-control-sm" name="photo" id="thumbnail" />
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="row w-75 m-auto mb-3">
                                <div class="col-6">
                                    <label for="Name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" id="name" name="name"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="col-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input required type="text" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto">
                            <button class="btn btn-primary" type="submit">Save Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
    {{-- 
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdrop1Label" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h1 class="modal-title fs-4" id="staticBackdrop1Label">Item media</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
        </div>
        <div class="modal-body border-0 d-flex flex-column">
            <img class="media m-auto p-2" id="preview-thumbnail"
                src="{{ asset('imgs/avatar.png') }}">
            <input required type="file" class="form-control thumbnail-input m-auto" name="photo"
                id="thumbnail" />
        </div>
        
    </div>
</div>
</div> --}}
