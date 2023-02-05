<div class="relative md:mt-0">
    <input wire:model="query" type="text"
        class="bg-gray-800 text-sm rounded py-2 w-64 px-4 pl-8 focus:outline-none focus:shadow-outline"
        placeholder="Search" />
    @if (strlen($query) > 1)
        <div class="bg-white position-absolute" x-show.transition.opacity="isOpen" style="z-index: 1;">
            @if ($results->count() > 0)
                <ul class=" list-group">
                    @foreach ($results as $result)
                        <li class="list-group">
                            <a href="{{ route('item.select', $result['id']) }} "
                                class="block hover:bg-gray-700 text-gray-200 px-3 py-3 items-center transition ease-in-out duration-150">
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
