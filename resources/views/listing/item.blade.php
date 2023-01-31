@extends('layouts.layout')
@section('content')
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="p-2">
                <div class="card bg-transparent border-0 p-1">
                    <div class="card-header p-2 bg-white">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-2">
                                <li class="breadcrumb-item fs-5 text-decoration-underline"><a
                                        href="{{ route('item.list') }}">Item lists</a></li>
                                <li class="breadcrumb-item fs-5" aria-current="page">{{ $item->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-body bg-transparent">
                        <div class="row mb-3">
                            <div class="col-7 bg-white container m-0 rounded-2 p-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-bolder">{{ $item->title }}</h5>
                                    <div class="d-flex p-0 m-0 gap-2 align-self-end">
                                        <button class="btn px-3 rounded-3 my-bg-third d-flex align-items-center gap-1"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="edit-item-profile"
                                            value="{{ $item->id }}">
                                            <span class="material-icons-sharp fs-6 my-text-primary">
                                                edit
                                            </span>
                                            <small class="my-text-primary">Edit item profile</small>
                                        </button>
                                        <button class="p-0 btn px-3 rounded-3 my-bg-third d-flex align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                            <span class="material-icons-sharp p-0 m-auto my-danger fs-5">delete</span>
                                            <small class="my-danger">Delete</small>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <small class="text-muted mb-4">{{ $item->description }}</small>
                                    <div class="container mb-3">
                                        <h6 class="mb-1 fw-bolder">Item information</h6>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Transaction number</p>
                                            <p class="text-muted mb-0">{{ $item->transaction_no }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Inventory number</p>
                                            <p class="text-muted mb-0">{{ $item->inventory_number }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Classification</p>
                                            <p class="text-muted mb-0">{{ $item->classification }}</p>
                                        </div>
                                    </div>

                                    <div class="container mb-3">
                                        <h6 class="mb-1 fw-bolder">Purchase Information</h6>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Purchase Date</p>
                                            <p class="text-muted mb-0">{{ $item->purchase_date }}</p>
                                        </div>
                                       
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Warranty</p>
                                            <p class="text-muted mb-0">{{ $item->warranty }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Supplier</p>
                                            <p class="text-muted mb-0">{{ $item->supplier }}</p>
                                        </div>
                                    </div>

                                    <div class="container mb-3">
                                        <h6 class="mb-1 fw-bolder">Information on Value</h6>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Salvage Value</p>
                                            <p class="text-muted mb-0">{{ $item->depreciation }}</p>
                                        </div>
                                    </div>

                                    <div class="container mb-3">
                                        <h6 class="mb-1 fw-bolder">Registration details</h6>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Date Registered</p>
                                            <p class="text-muted mb-0">{{ $item->created_at }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-muted mb-0">Inventoried by</p>
                                            <p class="text-muted mb-0">
                                                {{ $item->inventoried_by->name }}
                                                ({{ $item->inventoried_by->position }})
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 bg-transparent container rounded-2 p-0">
                                <div class="container">
                                    <div class="row bg-white p-3 mb-3 rounded-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5>Thumbnail</h5>
                                            <button class="p-0 btn px-3 rounded-3 my-bg-third mb-2" type="button"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop4">
                                                Change
                                            </button>
                                        </div>
                                        <img class="w-25 img-thumbnail ms-3"
                                            src="{{ $item->image ? asset('storage/' . $item->image) : asset('imgs/BFP Logo.png') }}"
                                            alt="thumbnail">
                                    </div>
                                    <div class="row bg-white rounded-2 p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5>Media</h5>
                                            <button class="p-0 btn px-3 rounded-3 my-bg-third mb-2" type="button"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                                Edit media
                                            </button>
                                        </div>

                                        <img class="img-thumbnail ms-3 media-profile"
                                            src="{{ $medias->media1 ? asset('storage/' . $medias->media1) : '' }}"
                                            alt="thumbnail">
                                        <img class="img-thumbnail ms-3 media-profile"
                                            src="{{ $medias->media2 ? asset('storage/' . $medias->media2) : '' }}"
                                            alt="thumbnail">
                                        <img class="img-thumbnail ms-3 media-profile"
                                            src="{{ $medias->media3 ? asset('storage/' . $medias->media3) : '' }}"
                                            alt="thumbnail">
                                    </div>

                                    <div class="row">
                                        <button
                                            class="btn my-btn-primary d-flex gap-2 align-items-center justify-content-center rounded-5 mt-5 m-auto p-3"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop5">
                                            <span class="material-icons-outlined text-white fs-4">add_box</span>
                                            Add new serial
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row bg-white rounded-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="p-3">Serial</th>
                                        <th scope="col" class="p-3">Condition</th>
                                        <th scope="col" class="p-3">Color</th>
                                        <th scope="col" class="p-3">Price</th>
                                        <th scope="col" class="p-3">Location</th>
                                        <th scope="col" class="p-3">Life span</th>
                                        <th scope="col" class="p-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($serials as $serial)
                                        <tr>
                                            <td class="p-3">{{ $serial->serial_no }}</td>
                                            <td class="p-3">
                                                <div class="d-flex align-items-center align-self-center">
                                                    <span
                                                        class="material-icons-sharp fs-6 me-1 @if ($serial->condition == 'Functional') my-text-success
                                                        @else text-danger @endif">
                                                        circle
                                                    </span>
                                                    {{ $serial->condition }}
                                                </div>
                                            </td>
                                            <td class="p-3">{{ $serial->color }}</td>
                                            <td class="p-3">{{ $serial->price }}</td>
                                            <td class="p-3">{{ $serial->location }}</td>
                                            <td class="p-3">{{ $serial->lifespan }}</td>
                                            <td style="width: 18% !important;">
                                                <div class="d-flex">
                                                    <button type="button"
                                                        class="btn my-bg-secondary rounded-5 mt-2 p-0 px-2 edit-serial"
                                                        value="{{ $serial->id }}">
                                                        <small class="p-3 text-black">Edit</small>
                                                    </button>

                                                    <button type="button"
                                                        class="btn my-bg-danger rounded-5 mt-2 p-0 ms-4 remove-serial"
                                                        value="{{ $serial->id }}">
                                                        <small class="p-3 text-white">Remove</small>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $serials->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="" method="POST" action="{{ route('item.update', ['id' => $item->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="staticBackdropLabel">Editing item profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label for="item_title" class="form-label">Item title</label>
                            <input required type="text" class="form-control" id="item_title" name="title">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <input required type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="col-md-4">
                            <label for="inventory_no" class="form-label">Inventory No</label>
                            <input required type="text" class="form-control" id="inventory_no"
                                name="inventory_number">
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label">Purchased date</label>
                            <input required type="text" class="form-control" id="date" name="purchase_date">
                        </div>
                        <div class="col-md-4">
                            <label for="classification" class="form-label">Classification</label>
                            <select id="classification" class="form-select" name="classification">
                                <option value="Land">Land</option>
                                <option value="Buildings">Buildings</option>
                                <option value="Office Equipment">Office Equipment</option>
                                <option value="Appliances">Appliances</option>
                                <option value="Vehicle">Vehicle</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="depreciation" class="form-label">Salvage value</label>
                            <input required type="number" class="form-control" id="depreciation" name="depreciation">
                        </div>
                        <div class="col-md-4">
                            <label for="warranty" class="form-label">Warranty</label>
                            <input required type="text" class="form-control" id="warranty" name="warranty">
                        </div>
                        <div class="col-md-4">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input required type="text" class="form-control" id="supplier" name="supplier">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn my-bg-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn my-btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Delete item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 mb-0 p-0 ps-3 pt-2">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <form action="{{ route('item.destroy', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <div class="modal-footer border-0">
                        <button type="button" class="btn my-bg-third border my-primary" data-bs-dismiss="modal">No,
                            cancel</button>
                        <button type="submit" class="btn my-bg-danger"> Yes, delete item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Item thumbnail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('item.thumbnail.update', ['id' => $item->id]) }}" method="POST"
                    enctype="multipart/form-data" id="thumbnail-form">
                    @csrf
                    @method('PUT')
                    <div class="modal-body border-0 d-flex flex-column">
                        <img class="media m-auto p-2" id="preview-thumbnail"
                            src="{{ $item->image ? asset('storage/' . $item->image) : asset('imgs/BFP Logo.png') }}">
                        <input required type="file" class="form-control thumbnail-input m-auto" name="thumbnail"
                            id="thumbnail" />
                    </div>
                    <div class="container">
                        <div class="moda-footer">
                            <div class="modal-footer border-0">
                                <button type="button" class="btn my-bg-third border my-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn my-btn-primary" form="thumbnail-form">
                                    Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Item media</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container">
                    <form action="{{ route('item.media.update', ['id' => $item->id]) }}" method="POST" id="media-form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row bg-white rounded-2 p-3">
                            <div class="row mb-2">
                                <div class="mb-2 col-6">
                                    <img class="media" id="preview-media1"
                                        src="{{ $medias->media1 ? asset('storage/' . $medias->media1) : asset('imgs/BFP Logo.png') }}">
                                    <input type="file" class="form-control media-input" name="media1"
                                        id="media1" />
                                </div>
                                <div class="mb-5 col-6">
                                    <img class="media" id="preview-media2"
                                        src="{{ $medias->media2 ? asset('storage/' . $medias->media2) : asset('imgs/BFP Logo.png') }}">
                                    <input type="file" class="form-control media-input" name="media2"
                                        id="media2" />
                                </div>
                                <div class="mb-5 col-6">
                                    <img class="media" id="preview-media3"
                                        src="{{ $medias->media3 ? asset('storage/' . $medias->media3) : asset('imgs/BFP Logo.png') }}">
                                    <input type="file" class="form-control media-input" name="media3"
                                        id="media3" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn my-bg-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn my-btn-primary" form="media-form">
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="staticBackdrop5" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Serial form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('serial.store', ['reference_no' => $item->id]) }}" method="POST"
                    id="serial-form">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="serial_no">Serial No.</label>
                                <input type="text" id="serial_no" name="serial_no" class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="price">Price</label>
                                <input type="text" id="price" name="price" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="condition">Condition</label>
                                <select id="condition" name="condition" class="form-select">
                                    <option value="Functional">Functional</option>
                                    <option value="Non-Functional">Non-functional</option>
                                </select>
                            </div>
                            
                            <div class="mb-3 col-6">
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color" value="none"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="lifespan">Lifespan</label>
                                <input type="text" id="lifespan" name="lifespan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="moda-footer">
                            <div class="modal-footer border-0">
                                <button type="button" class="btn my-bg-third border my-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn my-btn-primary" form="serial-form">
                                    Submit form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Serial form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('serial.update', ['reference_no' => $item->id]) }}" method="POST"
                    id="edit-serial-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="serial-id" name="id">
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="serial_no">Serial No.</label>
                                <input type="text" id="edit-serial_no" name="serial_no" class="form-control">
                            </div>
                                <div class="mb-3 col-6">
                                    <label for="price">Price</label>
                                    <input type="text" id="edit-price" name="price" class="form-control">
                                </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="condition">Condition</label>
                                <select id="condition" name="condition" class="form-select">
                                    <option value="Functional">Functional</option>
                                    <option value="Non-Functional">Non-functional</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="color">Color</label>
                                <input type="text" id="edit-color" name="color" value="none"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="location">Location</label>
                                <input type="text" id="edit-location" name="location" class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="lifespan">Lifespan</label>
                                <input type="text" id="edit-lifespan" name="lifespan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="moda-footer">
                            <div class="modal-footer border-0">
                                <button type="button" class="btn my-bg-third border my-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn my-btn-primary" form="edit-serial-form">
                                    Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-4" id="staticBackdrop1Label">Delete serial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 mb-0 p-0 ps-3 pt-2">
                    <p>Are you sure you want to delete this serial?</p>
                </div>
                <form action="{{ route('serial.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="remove-serial-id">
                    <div class="modal-footer border-0">
                        <button type="button" class="btn my-bg-third border my-primary" data-bs-dismiss="modal">No,
                            cancel</button>
                        <button type="submit" class="btn my-bg-danger"> Yes, delete serial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
