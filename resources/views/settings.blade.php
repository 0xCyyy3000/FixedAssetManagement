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
                    <div class="overflow-hidden text-center"> 
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
                    
                        <div class="card-footer text-center">
                            <button class="btn btn-success">Update</button>
                        </div>

                    <div class="d-flex justify-content-center ">
                    <div class="row p-2">
                        <div class="mb-2 col-6 ">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Change Password
                            </button>
                        </div>
                        @if(Auth()->user()->position == 1)
                        <div class="mb-2 col-6 ">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#badge">
                                Add Badge
                            </button>
                        </div>
                        @endif
                    </div>
                    </div>
                       <div class="col">
                            {{-- <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Change Password
                            </button> --}}
                        {{-- <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#badge">
                            Add Badge
                          </button> --}}
                        </div>
                </form>
            </div>
        </div>
    @endsection

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Password Update</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.updatepass') }}">
                    @csrf
                    @method('PUT')
                <div class="row align-items-center w-75 m-auto mb-3">
                    <div class="d-grid gap-2 col-5 mx-auto">
                    <label for="oldPasswordInput" class="form-label">Old Password</label>
                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                        placeholder="Old Password">
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>
                <div class="d-grid gap-2 col-5 mx-auto">
                <div class="row align-items-center w-75 m-auto mb-3">
                    <label for="newPasswordInput" class="form-label">New Password</label>
                    <input name="new_password"  class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                        placeholder="New Password">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 col-5 mx-auto">
                <div class="row align-items-center w-75 m-auto mb-3">
                    <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                    <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation"
                        placeholder="Confirm New Password">
                </div>
            </div>
        
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
    </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="badge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Badge</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('badge.add') }}">
                    @csrf
                
                    <div class="row w-75 m-auto mb-3">
                        <div class="mb-3 col-4">
                            <label for="section" class="form-label">Badge Number</label>
                            <input type="text" class="form-control" id="badge_number" name="badge_number">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="appendix_no" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name">
                        </div>
                    </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
    </div>
          </div>
        </div>
      </div>
    
    
    
