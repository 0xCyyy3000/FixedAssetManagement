@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 border-bottom border-3 mb-3">
                    <h5 class="col pt-2">Purchase Request Information</h5>
                    <a href="{{ route('purchase.create') }}"
                        class="col-2 btn my-btn-primary d-flex gap-2 align-items-center rounded-3">
                        <span class="material-icons-outlined text-white fs-4">add_box</span>
                        Create Purchase Request
                    </a>
                </div>
                <div class="container">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">TR No.</th>
                                <th scope="col">Office Section</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($requests))
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->created_at }}</td>
                                        <td>{{ $request->transaction_no }}</td>
                                        <td>{{ $request->office_section }}</td>
                                        <td>{{ $request->amount }}</td>
                                        <td>{{ $request->status }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-primary me-3" value="{{ $request->id }}">
                                                View details</button>
                                            <button class="btn btn-primary me-3" value="{{ $request->id }}">Edit</button>
                                            <form action="{{ route('purchase.destroy') }}" method="post" id="remove-item">
                                                <button class="btn btn-danger" form="remove-item" name="reference"
                                                    value="{{ $request->id }}" type="submit">Remove</button>
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
