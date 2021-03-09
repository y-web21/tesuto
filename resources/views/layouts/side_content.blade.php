<div>
    <aside class="bg-white border-2 border-gray-300 rounded-md tracking-normal break-all shadow-md w-full h-100per">
        <div class="border-b-2 box-border border-blue-400 my-2 p-4">
            <h2 class="font-semibold text-lg">アクセスランキング</h2>
        </div>
        <div class="p-4 w-full divide-gray-500 divide-y">
            @php
                $counter = 1;
            @endphp
            @foreach ($ranking as $item)
                <a class="flex justify-between w-full py-3 hover:opacity-70"
                    href={{ route('article.show', ['article' => $item->id]) }}>
                    <p class="my-auto text-4xl mx-1 whitespace-nowrap">{{ $counter }}</p>
                    <div class="flex items-center w-full">
                        @if ($item->name === null)
                            <img class="rounded-md border-gray-300 object-cover rank-image mx-auto" alt="no_image"
                                src="{{ asset('storage/images/no_image.png') }}">
                        @else
                            <img class="rounded-md border-gray-300 object-cover rank-image mx-auto"
                                alt="{{ $item->description }}"
                                src="{{ asset('storage/images/' . $item->name) }}">
                        @endif
                    </div>
                    <div class="flex flex-col w-full mx-5 my-auto overflow-hidden">
                        <h3 class="text-lg font-semibold">{{ Helper::strlimit($item->title, 30) }}</h3>
                    </div>
                </a>
                @php
                    $counter++;
                @endphp
            @endforeach
        </div>
    </aside>
</div>
