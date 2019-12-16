@extends('admin.layouts.admin')

@section('content')


    <h2>{{ $title }}</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Дата</th>
                <th>Текст</th>
            </thead>
        </tr>
        @foreach($newss as $news)
            <tr>
                <td class="date">
                    {{ $news->date->format('d.m.Y') }}
                </td>
                <td class="title">
                    <a href="{{ route('admin.news.edit', ['news' => $news->id]) }}" class="table-news-title">{!! mb_substr(strip_tags($news->text), 0, 200) !!}...</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $news->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список новостей
@endsection

