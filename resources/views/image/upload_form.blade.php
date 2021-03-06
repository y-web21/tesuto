@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
// $disp_header = config('const.common.BLADE.HEADER.DISABLE');
@endphp


@section('content')


    @include('poster.parts.layouts')

    <div class="bg-gray-400 sticky top-0 text-black text-center w-full mb-6 z-40">
        <form class="p-5 lg:flex items-center" action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="m-4 lg:w-full">
                <input type="text" name="title"
                value="{{ old('title') }}"
                placeholder="画像タイトルを入力してください" class="w-full form-active-blue text-opacity-10 hidden">
            </div>
            <div class="m-4 lg:w-full">
                <input class="cursor-pointer" type="file" name="image" accept="image/png, image/jpeg, image/png, image/gif">
                {{-- <input type="file" name="image" accept="image/*"> --}}
            </div>
            <div class="m-4  lg:w-full">
                <button type="submit" class="btn-white">アップロード</button>
            </div>
            <div class="m-4 lg:w-full text-red-600">
                @error('image')
                    {{ $message }}
                @enderror
            </div>

        </form>
    </div>


    <div class="px-4 py-6">

        <div>
            <h2 class="text-2xl font-semibold">画像一覧</h2>
            <hr>
        </div>

        @error('page')
            <p class="text-red-600">
                {{ $message }}
            </p>
        @enderror


        <!-- image cards -->
        <div>
            <div class="relative items-center justify-center">

                @php
                    $counter = 0;
                @endphp

                @foreach ($images as $image)

                    @if ($counter % 3 === 0)
                        <div class="lg:flex mx-auto my-auto w-full justify-around items-end mt-8">
                    @endif

                    <div class="lg:m-4 shadow-md hover:shadow-lg hover:bg-gray-100 rounded-lg bg-white my-12 w-full">
                        <!-- Card Image -->
                        <a href="{{ route('image.show', $image->id) }}">
                            <img src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}"
                                class=" w-full object-contain"></a>

                        <!-- Card Content -->
                        <div class="p-4 w-full">
                            {{-- <h3 class="font-medium text-gray-600 text-lg my-2 uppercase">{{ $image->description }}</h3> --}}
                            <p class="text-justify">{{ $image->updated_at }}</p>
                            <div class="mt-3">
                                <form action={{ route('image.del-req') }} method="post" style="display:inline-block;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                    <button type="submit" class="btn-red">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($counter % 3 === 2)
                        </div>
                    @endif

                    @php
                        $counter++;
                    @endphp
                @endforeach

                @if ($counter % 3 !== 2)
                    @for ($i = 0; $i <= $counter % 3; $i++)
                        <div class="lg:m-4 my-12 w-full"></div>
                    @endfor
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{ $images->links('layouts.paginator.default') }}

    @include('poster.parts.layouts_close')


@endsection
