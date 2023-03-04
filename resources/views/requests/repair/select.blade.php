@extends('layouts.layout')
@section('content')
    <div class="overflow-hidden px-3">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 sticky-top shadow">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fs-5 text-decoration-underline "><a
                                    href="{{ route('repair.request') }}">Repair Requests</a></li>
                            <li class="breadcrumb-item fs-5" aria-current="page">See details</li>
                        </ol>
                    </nav>
                </div>
                <div class="row p-3">
                    <div class="row mb-4">
                        <h3 class="text-center fw-semibold">Purchase Request Form</h3>
                        <small class="text-center text-muted">{{ $request->transaction_no }}</small>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-3 col-4">
                            <label for="repair_date" class="form-label">Submitted on</label>
                            <p class="text-muted fw-bold"> {{ $request->created_at }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="repair_date" class="form-label">Requested by</label>
                            <p class="text-muted fw-bold">{{ Auth::user()->requester($request->requester)->name }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="entity" class="form-label">Entity Name</label>
                            <p class="text-muted fw-bold"> {{ $request->entity }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="fund_cluster" class="form-label">Fund Cluster</label>
                            <p class="text-muted fw-bold">{{ $request->fund_cluster }} </p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="section" class="form-label">Office Section</label>
                            <p class="text-muted fw-bold">{{ $request->office_section }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="appendix_no" class="form-label">Appendix No.</label>
                            <p class="text-muted fw-bold"> {{ $request->appendix_no }}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden mt-5 mb-3">
                        <table class="table mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Cost</th>
                                </tr>
                            </thead>
                            <tbody id="replace-items-table-body">
                                @foreach ($serials as $serial)
                                    <tr>
                                        <td>{{ $serial->title }}</td>
                                        <td>{{ $serial->serial_no }}</td>
                                        <td>{{ $serial->remarks }}</td>
                                        <td>₱{{ $serial->cost }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="text-end d-none" id="replace-items-total"></h4>
                    </div>
                    @if (Auth()->user()->position == 2)
                        <form action="{{ route('repair.update') }}" method="post">
                            @csrf
                            <div class="row p-3 w-25">
                                <label for="status" class="form-label ps-0">Status</label>
                                <select class="form-select" name="status">
                                    <option value="Pending" @if ($request->status == 'Pending') selected @endif>Pending
                                    </option>
                                    <option value="Approved" @if ($request->status == 'Approved') selected @endif>Approved
                                    </option>
                                    <option value="Rejected" @if ($request->status == 'Rejected') selected @endif>Rejected
                                    </option>
                                </select>
                            </div>
                            <div class="d-flex p-3 justify-content-end gap-2">
                                <input type="hidden" id="repair_token" value="{{ csrf_token() }}">
                                <a href="{{ route('repair.request') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn my-btn-primary" name="id"
                                    value="{{ $request->id }}">Save changes</button>
                                {{-- <a href="{{ route('purchasePdf', ['id' => $request->id]) }}"class="btn btn-primary btn-sm float-end mx-1"  target="_blank">View PDF</a> --}}

                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
