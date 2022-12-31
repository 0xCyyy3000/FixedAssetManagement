<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="layout row" style="background-color: #e0e0e0">
        <nav class="bg-transparent p-0 col-2 position-relative" style="">
            <ul class="list-group bg-white rounded-0 p-3 position-relative">
                <li class="w-50 mt-3 m-auto mb-4 list-group ">
                    <img class="w-100" src="{{ asset('imgs/BFP Logo.png') }}" alt="bfp.logo">
                </li>
                <li class="list-group">
                    <a href="#"
                        class="active fs-6 rounded-3 mb-2 fs-5 d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1">
                        <img class="mb-1 me-2" src="{{ asset('imgs/category.png') }}" alt="" width="14"
                            height="14">
                        Dashboard
                    </a>
                </li>
                <li class="list-group">
                    <a href="#"
                        class="fs-6 rounded-3 mb-2 fs-5 d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1">
                        <img class="mb-1 me-2" src="{{ asset('imgs/layer.png') }}" alt="" width="14"
                            height="14">
                        Item List
                    </a>
                </li>
                <li class="list-group">
                    <a href=""
                        class="fs-6 rounded-3 mb-2 fs-5 d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1">
                        <img class="mb-1 me-2" src="{{ asset('imgs/documenttext.png') }}" alt="" width="14"
                            height="14">
                        Process Request
                    </a>
                </li>
                <li class="list-group">
                    <a href=""
                        class="fs-6 rounded-3 mb-2 fs-5 d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1">
                        <img class="mb-1 me-2" src="{{ asset('imgs/book.png') }}" alt="" width="14"
                            height="14">
                        Data Entry
                    </a>
                </li>
                <li class="list-group">
                    <a href=""
                        class="fs-6 rounded-3 mb-2 fs-5 d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1">
                        <img class="mb-1 me-2" src="{{ asset('imgs/book.png') }}" alt="" width="14"
                            height="14">
                        Reports
                    </a>
                </li>
            </ul>

            <div class="position-absolute bottom-0 p-3 mb-5">
                <a class="text-decoration-none text-black fs-6 rounded-3 mb-2 fs-5  d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1"
                    href="#">
                    <img class="mb-1 me-2" src="{{ asset('imgs/documenttext.png') }}" alt="" width="14"
                        height="14">
                    Transaction History
                </a>
                <a class="text-decoration-none text-black fs-6 rounded-3 mb-2 fs-5  d-inline-block align-text-top pe-4 ps-4 pt-1 pb-1"
                    href="#">
                    <img class="mb-1 me-2" src="{{ asset('imgs/setting4.png') }}" alt="" width="14"
                        height="14">
                    Settings
                </a>
            </div>
        </nav>
        <div class="col">
            <div class="p-4">
                <div class="row bg-white rounded p-2 align-items-center">
                    <h4 class="col fw-bold fs-4 m-0">Fixed Assets Information Management</h4>
                    <div class="col d-flex gap-3">
                        <form class="d-flex">
                            <div class="input-group border-0">
                                <input type="search" class="form-control my-bg-third" placeholder="Search"
                                    aria-label="Username" aria-describedby="basic-addon1">
                                <span class="input-group-text p-0 my-bg-third" id="basic-addon1">
                                    <button
                                        class="btn rounded-3 h-75 ps-3 pe-3 me-2 d-flex justify-content-center align-items-center my-bg-secondary">
                                        <small class="fw-bold">Search</small>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <button class="btn d-flex gap-1 align-items-center p-1 ps-2 pe-2 my-bg-secondary"
                            type="button">
                            New
                            <span class="material-symbols-rounded">add_circle</span>
                        </button>
                        <button class="btn d-flex gap-1 align-items-center p-1 ps-2 pe-2 my-bg-secondary"
                            type="button">
                            <span class="material-icons my-primary">notifications</span>
                        </button>
                        <div class="d-flex gap-0 align-items-center profile">
                            <div class="row">
                                <h1 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h1>
                                <small class="text-muted">Chief Inspector</small>
                            </div>
                            <img class="my-bg-secondary rounded-4" src="{{ asset('imgs/avatar.png') }}"
                                alt="" width="42" height="42">
                            <div class="drop-down">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
