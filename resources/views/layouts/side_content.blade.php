<div>
    <aside class="bg-white border-2 border-gray-300 rounded-md tracking-normal break-all shadow-lg w-full h-100per">
        <div class="border-b-2 box-border border-blue-400 mb-2 p-4">
            <h2 class="font-semibold text-lg">アクセスランキング</h2>
        </div>
        <div class="p-7 w-full divide-gray-500 divide-y">
            @php
                $counter = 1;
            @endphp
            @foreach ($articles as $article)
                <a class="flex justify-between w-full py-3"
                    href={{ route('article.show', ['article' => $article->id]) }}>
                    <p class="my-auto text-4xl mr-1">{{ $counter }}</p>
                    <div class=" w-full">
                        @if ($article->uploadImage === null)
                            <img class="rounded-md border-gray-300 object-cover rank-image mx-auto"
                                alt="no_image" src="{{ asset('storage/images/no_image.png') }}">
                        @else
                            <img class="rounded-md border-gray-300 object-cover rank-image mx-auto"
                                alt="{{ $article->uploadImage->description }}"
                                src="{{ asset('storage/images/' . $article->uploadImage->name) }}">
                        @endif
                    </div>
                    <div class="flex flex-col w-full mx-5 my-auto overflow-hidden">
                        <h3 class="text-lg font-semibold">{{ Helper::strlimit($article->title, 30) }}</h3>
                    </div>
                </a>
                @php
                    $counter++;
                @endphp
            @endforeach
        </div>
    </aside>
</div>
