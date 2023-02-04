{{-- <div>
    <form class="d-flex">
        <div class="input-group border-0">
            <input wire:model="query" type="search" class="form-control my-bg-third" placeholder="Search"
                aria-label="Username" aria-describedby="basic-addon1">
            <span class="input-group-text p-0 my-bg-third" id="basic-addon1">
                <button
                    class="btn rounded-3 h-75 ps-3 pe-3 me-2 d-flex justify-content-center align-items-center my-bg-secondary">
                    <small class="fw-bold">Search</small>
                </button>
            </span>
        </div>
    </form>
</div> --}}
<div class="relative mt-3 md:mt-0">
    <input wire:model="query" type="text" class="bg-gray-800 text-sm rounded py-2 w-64 px-4 pl-8 focus:outline-none focus:shadow-outline" placeholder="Search" />
    @if(strlen($query) > 2)
    <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">
       @if($results->count() > 0)
        <ul>
            @foreach($results as $result)
            <li class="border-b border-gray-700">
                <a href="{{ route('item.select', $result['id']) }} " class="block hover:bg-gray-700 text-gray-200 px-3 py-3 items-center transition ease-in-out duration-150">
                    <span class="ml-4">{{ $result->title }}</span>
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="m-2 p-2 text-gray-50">
            No results
        </div>
        @endif
    </div>
    @endif
</div>
