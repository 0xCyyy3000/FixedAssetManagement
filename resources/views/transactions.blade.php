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
                                        @if ($item->type==5)
                                        <td>
                                        <a href="ProfileItem/select/{{ $item->reference }}"  class=" btn">
                                            {{ $item->content }}
                                        </a>
                                        </td>
                                        @endif
                                   
                                        @if ($item->type==2)
                                        <a href=""  class=" btn ">
                                            <td>{{ $item->content }}</td>
                                        </a>
                                        @endif
                                        @if ($item->type==1)
                                        <a href=""  class=" btn ">
                                            <td>{{ $item->content }}</td>
                                        </a>
                                        @endif
                                        @if ($item->type==3)
                                        <a href=""  class=" btn ">
                                            <td>{{ $item->content }}</td>
                                        </a>
                                        @endif
                                        @if ($item->type==4)
                                        <a href=""  class=" btn ">
                                            <td>{{ $item->content }}</td>
                                        </a>
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
