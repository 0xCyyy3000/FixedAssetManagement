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
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="container text-center"> 
                    <div class="text-center w-80 m-auto mb-3">
                        <img class="my-bg-secondary rounded-4" id="preview-thumbnail"
                            src="{{ $user->photo ? asset('photo/' . $user->photo) : asset('imgs/avatar.png') }}"
                            alt="" width="200" height="200">
                    </div>
                    <div class="row align-items-start w-75 m-auto mb-3">
                    <div class="d-grid gap-2 col-5 mx-auto">
                        <input type="file" class="form-control" name="photo" id="thumbnail" />
                    </div>
                    </div>
                     <div class="row align-items-start w-75 m-auto mb-3">
                          <div class="d-grid gap-2 col-5 mx-auto">
                            <label for="formGroupExampleInput" class="form-label">Username</label>
                            <input required type="text" class=" form-control text-center" id="name" name="name"
                            value="{{ $user->name }}">
                          </div>
                    
                        </div>
                        <div class="row align-items-center w-75 m-auto mb-3">
                          <div class="d-grid gap-2 col-5 mx-auto">
                            <label for="formGroupExampleInput" class="form-label">Email</label>
                            <input required type="text" class=" form-control text-center" id="email" name="email"
                            value="{{ $user->email }}">
                          </div>
                        </div>
                      </div>
                      
                    {{-- <div class="card-body">

                        

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
                            <button class="btn my-btn-primary mb-3" type="button" data-toggle="modal"
                                data-target="#change_password">Change Password</button>
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto ">
                            <button class="btn my-btn-primary mb-3 " type="submit">Save Edit</button>
                        </div>
                    </div> --}}

                        <div class="card-body">
                          

                            <div class="row align-items-center w-75 m-auto mb-3">
                                <div class="d-grid gap-2 col-5 mx-auto">
                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="d-grid gap-2 col-5 mx-auto">
                            <div class="row align-items-center w-75 m-auto mb-3">
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-5 mx-auto">
                            <div class="row align-items-center w-75 m-auto mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirm New Password">
                            </div>
                        </div>

                        </div>

                        <div class="card-footer text-center">
                            <button class="btn btn-success">Update</button>
                        </div>
                </form>
            </div>
        </div>
    @endsection

    