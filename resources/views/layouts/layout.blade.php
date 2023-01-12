<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('imgs/BFP Logo.png') }}" type="image/x-icon">

    <title>Fixed Assets</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/clickEvents.js') }}"></script>
    <script src="{{ asset('js/datePicker.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="layout row" style="background-color: #e0e0e0">
        <nav class="bg-transparent p-0 col-2 position-relative" style="">
            <ul class="list-group bg-white h-100 rounded-0 p-3 position-relative">
                <li class="w-75 mt-3 m-auto mb-4 list-group ">
                    <img class="w-100" src="{{ asset('imgs/BFP Logo.png') }}" alt="bfp.logo">
                </li>
                <li class="list-group">
                    <a href="{{ route('dashboard') }}"
                        class="fs-6 rounded-3 mb-2 fs-5 d-flex align-items-center pe-4 ps-4 pt-1 pb-1 {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <span class="material-icons-outlined me-2">category</span>
                        Dashboard
                    </a>
                </li>
                <li class="list-group">
                    <a href="{{ route('item.list') }}"
                        class="fs-6 rounded-3 mb-2 fs-5 d-flex align-items-center pe-4 ps-4 pt-1 pb-1 {{ Request::routeIs('item.list') ? 'active' : '' }}">
                        <span class="material-icons-outlined me-2">layers</span>
                        Item List
                    </a>
                </li>
                <li class="list-group">
                    <div class="accordion mb-2 pt-1 ps-4 pb-1 @if (Request::routeIs('purchase.request') ||
                        Request::routeIs('repair.request') ||
                        Request::routeIs('replace.request') ||
                        Request::routeIs('return.request')) active @endif"
                        id="accordionExample">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header bg-transparent fs-6 rounded-3 d-flex align-items-center"
                                id="headingOne">
                                <span class="material-icons-outlined me-2">book</span>
                                <button class="accordion-button collapsed bg-transparent p-0 fs-6" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Process Request
                                </button>
                            </h2>
                            <div id="collapseOne"
                                class="accordion-collapse collapse @if (Request::routeIs('purchase.request') ||
                                    Request::routeIs('repair.request') ||
                                    Request::routeIs('replace.request') ||
                                    Request::routeIs('return.request')) show @endif"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body pt-0 pb-0">
                                    <ul class=" list-group pt-2 @if (Request::routeIs('purchase.request') ||
                                        Request::routeIs('repair.request') ||
                                        Request::routeIs('replace.request') ||
                                        Request::routeIs('return.request')) selected @endif">
                                        <li class=" list-group">
                                            <a class="fs-6 d-flex mb-1 align-items-center
                                                @if (Request::routeIs('purchase.request')) selected @endif"
                                                href="{{ route('purchase.request') }}">
                                                <span class="material-icons-outlined me-2">shopping_cart</span>
                                                Purchase Request
                                            </a>
                                        </li>
                                        <li class=" list-group">
                                            <a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('repair.request')) selected @endif"
                                                href="{{ route('repair.request') }}">
                                                <span class="material-icons-outlined me-2">build</span>
                                                Repair Request
                                            </a>
                                        </li>
                                        <li class=" list-group"><a
                                                class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('replace.request')) selected @endif"
                                                href="{{ route('replace.request') }}">
                                                <span class="material-icons-outlined me-2">find_replace</span>
                                                Replace Request
                                            </a>
                                        </li>
                                        <li class=" list-group">
                                            <a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('return.request')) selected @endif"
                                                href="{{ route('return.request') }}">
                                                <span class="material-icons-outlined me-2">assignment_return</span>
                                                Return Request
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group">
                    <div class="accordion mb-2 pt-1 ps-4 pb-1 rounded-2 @if (Request::routeIs('itemshow') || Request::routeIs('usershow')) active @endif"
                        id="accordionExample2">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header bg-transparent fs-6 rounded-3 d-flex align-items-center"
                                id="headingTwo">
                                <span class="material-icons-outlined me-2">description</span>
                                <button class="accordion-button collapsed bg-transparent p-0 fs-6" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                    aria-controls="collapseTwo">
                                    Data entry
                                </button>
                            </h2>
                            <div id="collapseTwo"
                                class="accordion-collapse collapse @if (Request::routeIs('itemshow') || Request::routeIs('usershow')) show @endif"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                <div class="accordion-body pt-0 pb-0">
                                    <ul class="list-group pt-2 @if (Request::routeIs('itemshow') || Request::routeIs('usershow')) selected @endif">
                                        <li>
                                            <a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('itemshow')) selected @endif"
                                                href="{{ route('itemshow') }}">Fixed Asset
                                                Inventory Form</a>
                                        </li>
                                        <li><a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('usershow')) selected @endif"
                                                href="">
                                                User List Form
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group">
                    <div class="accordion mb-2 pt-1 ps-4 pb-1 @if (Request::routeIs('asset.report') || Request::routeIs('user.report')) active @endif"
                        id="accordionExample3">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header bg-transparent fs-6 rounded-3 d-flex align-items-center"
                                id="heading3">
                                <span class="material-icons-outlined me-2">description</span>
                                <button class="accordion-button collapsed bg-transparent p-0 fs-6" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true"
                                    aria-controls="collapse3">
                                    Reports
                                </button>
                            </h2>
                            <div id="collapse3"
                                class="accordion-collapse collapse @if (Request::routeIs('asset.report') || Request::routeIs('user.report')) show @endif"
                                aria-labelledby="heading3" data-bs-parent="#accordionExample3">
                                <div class="accordion-body pt-0 pb-0">
                                    <ul class=" list-group pt-2">
                                        <li>
                                            <a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('asset.report')) active @endif"
                                                href="">
                                                Fixed Asset Inventory Report
                                            </a>
                                        </li>
                                        <li><a class="fs-6 d-flex mb-1 align-items-center @if (Request::routeIs('user.report')) active @endif"
                                                href="">
                                                User List Report
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="position-fixed bottom-0 ps-3 mb-2">
                <a href="#"
                    class="text-black fs-6 rounded-3 mb-2 fs-5 d-flex align-items-center pe-4 ps-4 pt-1 {{ Request::routeIs('history') ? 'active' : '' }}">
                    <span class="material-icons-outlined me-2">work_history</span>
                    Transaction History
                </a>
                <a href="#"
                    class="text-black fs-6 rounded-3 mb-2 fs-5 d-flex align-items-center pe-4 ps-4 pt-1 {{ Request::routeIs('settings') ? 'active' : '' }}">
                    <span class="material-icons-outlined me-2">settings</span>
                    Settings
                </a>
            </div>
        </nav>
        <div class="col">
            <div class="p-4 pb-0">
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
                            <span class="material-icons">add_circle_outline</span>
                        </button>
                        <button class="btn d-flex gap-1 align-items-center p-1 ps-2 pe-2 my-bg-secondary"
                            type="button">
                            <span class="material-icons my-primary">notifications</span>
                        </button>
                        <div class="d-flex gap-0 align-items-center profile">
                            <div class="row">
                                <h1 class="mb-0 fw-semibold">
                                    @php
                                        $name = explode(' ', Auth::user()->name);
                                    @endphp
                                    {{ $name[0] }}</h1>
                                <small class="text-muted">{{ Auth::user()->getPosition()->position }}</small>
                            </div>
                            <img class="my-bg-secondary rounded-4" src="{{ asset('imgs/avatar.png') }}"
                                alt="" width="42" height="42">
                            <div class="drop-down">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="my-2">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
