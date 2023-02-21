@extends('layouts.layout')
@section('content')
    <div class="overflow-hidden p-3 pt-1">
        <div class="row justify-content-center">
            <div class="p-2">
                <div class="card">
                    <div class="card-body">
                        {{-- <livewire:user-table /> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Badge Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Postion</th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($users as $user)
                                
                                    <tr>
                                        <td>{{ $user->badge_number }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td> 
                                            <form method="POST" action="{{ route('updateUser', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                            <select name="position" id="position">
                                                <option value="1" {{ $user->position == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ $user->position == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ $user->position == '3' ? 'selected' : '' }}>3</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary float-end">Update</button>
                                            </form>
                                        </td>
                                        
                                        
                                    </tr>
                                 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection
