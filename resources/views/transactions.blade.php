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
                                        <a href="{{ route('repair.request') }}"><td>{{ $item->content }}</td></a>
                                        <td>{{ $item->created_at->formatLocalized('%A / %B %d %Y')}}</td>

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
