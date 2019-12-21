@extends('layouts.app', ['dep' => 'gallery'])

@section('content')

<section class="Gallery">
    <h1>Галерея</h1>

    @foreach ($galleries as $gallery)

        <div class="Gallery__item">
            <h3>{{ $gallery->title }}</h3>
            @if (strlen(strip_tags($gallery->description)) > 0)
            {!! $gallery->description !!}
            @endif
            <div class="Gallery__photos">
                @foreach($gallery->photos as $photo)
                    <a href="{{ asset('storage/GalleryFiles/' . $gallery->id . '/' . $photo->image) }}" title="{{ $photo->title }}" data-fancybox="gallery_{{ $gallery->id }}" data-caption="{{ $photo->title }}">
                        <img src="{{ asset('storage/GalleryFiles/' . $gallery->id . '/' . $photo->thumb) }}" alt="{{ $photo->title }}" />
                    </a>
                @endforeach
            </div>
        </div>

    @endforeach

</section>

@endsection