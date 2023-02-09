@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-auto p-2">Transaction History</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>

                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        @if ($item->type == 5)
                                            <td>
                                                {{ $item->content }}
                                                <a href="ProfileItem/select/{{ $item->reference }}" class="ms-4">
                                                    <small>View details</small>
                                                </a>
                                            </td>
                                        @elseif ($item->type == 1)
                                            <td>
                                                {{ $item->content }}
                                                <a href="/purchase-request/select/{{ $item->reference }}" class="ms-4">
                                                    <small>View details</small>
                                                </a>
                                            </td>
                                        @elseif ($item->type == 2)
                                            <td>
                                                {{ $item->content }}
                                                <a href="/repair-request/select/{{ $item->reference }}" class="ms-4">
                                                    <small>View details</small>
                                                </a>
                                            </td>
                                        @elseif ($item->type == 3)
                                            <td>
                                                {{ $item->content }}
                                                <a href="/replace-request/select/{{ $item->reference }}" class="ms-4">
                                                    <small>View details</small>
                                                </a>
                                            </td>
                                        @elseif ($item->type == 4)
                                            <td>
                                                {{ $item->content }}
                                                <a href="/return-request/select/{{ $item->reference }}" class="ms-4">
                                                    <small>View details</small>
                                                </a>
                                            </td>
                                        @endif
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
