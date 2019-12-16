@extends('layouts.app', ['dep' => 'news'])

@section('content')

<h1>Новости</h1>

<section class="News">
    @foreach($newss as $news)
        <div class="News__item">
            <div class="News__date">
                {{ $news->date->format('d.m.Y') }}
            </div>
            @if(file_exists(public_path('storage/NewsImages/'.$news->id.'/list.jpg')))
            <img src="{{ asset('storage/NewsImages/'.$news->id.'/list.jpg') }}" border="0" class="News__image"/>
            @endif
            {!! $news->text !!}
        </div>
    @endforeach

    <div class="clearfix"></div>

    <div class="pagination">
        {{ $newss->links() }}
    </div>


@endsection