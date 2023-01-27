@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 border-bottom border-3 mb-3">
                    <h5 class="col pt-2">Return Request Information</h5>
                    <a href="{{ route('return.create') }}"
                        class="col-2 btn my-btn-primary d-flex gap-2 align-items-center rounded-3">
                        <span class="material-icons-outlined text-white fs-4 ms-3">add_box</span>
                        Create Request
                    </a>
                </div>
                <div class="container">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction No.</th>
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
                                        <td>₱{{ $request->amount }}</td>
                                        <td>{{ $request->status }}</td>
                                        <td class="d-flex gap-2">
                                            <a type="button" class="btn my-bg-primary rounded-5 p-0" id="select-item"
                                                href="{{ route('return.select', ['id' => $request->id]) }}">
                                                <small class="p-3 text-white">See details</small>
                                            </a>
                                            <button type="button" class="btn btn-danger rounded-5 p-0" id="delete-return"
                                                value="{{ $request->id }}"data-bs-toggle="modal"
                                                data-bs-target="#remove-warning-return">
                                                <small class="p-3 text-white">Delete</small>
                                            </button>
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

    <form action="{{ route('return.destroy') }}" method="post" id="remove-request-return">
        @csrf
        <div class="modal fade" id="remove-warning-return" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-4" id="staticBackdrop1Label">
                            Delete item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0 mb-0 p-0 ps-3 pt-2">
                        <p>Are you sure you want to delete this request?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <input type="hidden" name="reference" id="return_remove_id">
                        <button type="button" class="btn my-bg-third border my-primary"
                            data-bs-dismiss="modal">No,cancel</button>
                        <button type="submit" class="btn my-bg-danger" form="remove-request-return">
                            Yes, delete request</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
