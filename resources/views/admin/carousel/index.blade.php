@extends('admin.layouts.admin')

@section('content')


    <h2>Список слайдов карусели</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Дата</th>
                <th>Название</th>
            </thead>
        </tr>
        @foreach($slides as $slide)
            <tr>
                <td class="date">
                    {{ $slide->date_begin->format('d.m.Y') }}
                </td>
                <td class="title">
                    <a href="{{ route('admin_carousel_edit', ['slide' => $slide->id]) }}" class="table-slide-title">{{ $slide->title }}</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $slide->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список слайдов карусели
@endsection

