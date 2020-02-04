@extends('layouts.app', ['dep' => 'tickets'])


@section('content')

    <section class="Carousel">
        <div class="Carousel__container" data-addon="carousel">
            @foreach($slides as $slide)
            <div class="Carousel__item">
                <a href="{{ $slide->url }}" target="_blank" class="image" title="{{ $slide->title }}">
                    <img src="{{ asset('storage/CarouselImages/' . $slide->image) }}" border="0" alt="{{ $slide->title }}" />
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="Tickets">
    @foreach($events as $event)
        <div class="Tickets__item">
            <a href="{{ $event->meeting_url }}" class="image" target="_blank">
                <img src="{{ asset('storage/EventImages/'.$event->id.'/list.jpg') }}" border="0" />
            </a>
            <a href="{{ base64_decode($event->tickets_url) }}" class="buy" target="_blank">Купить билет</a>
        </div>
    @endforeach
</section>


@endsection