@extends('admin.layouts.admin')

@section('content')


    <h2>Фотогалереи</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Название</th>
            </thead>
        </tr>
        @foreach($galleries as $gallery)
            <tr>
                <td class="title">
                    <a href="{{ route('admin.galleries.edit', ['gallery' => $gallery->id]) }}" class="table-gallery-title">{{ $gallery->title }}</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $gallery->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список фотогалерей
@endsection

