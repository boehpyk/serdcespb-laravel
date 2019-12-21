@extends('layouts.app', ['dep' => 'events'])

@section('content')

<section class="Events">
    @if (count($banners) > 0)
        <div class="Banners">
        @foreach($banners as $banner)
            <div class="Banners__item">
                <a href="{{ $banner->url }}" target="_blank">
                    <img src="{{ asset('storage/BannerImages/' . $banner->image) }}" border="0" />
                </a>
            </div>
        @endforeach
        </div>
    @endif
    <div class="Events__list">
        @foreach($events as $event)
            <div class="Events__item">
                <a href="{{ $event->meeting_url }}" class="link" target="_blank">
                    <img src="{{ asset('assets/img/vk_logo48x48.jpg') }}" border="0" />
                </a>
                <div class="date">
                    {{ $event->date_begin->format('d.m') }}
                </div>
                <div class="title">
                    {{ $event->title }}
                </div>
            </div>
        @endforeach
    </div>
</section>


@endsection