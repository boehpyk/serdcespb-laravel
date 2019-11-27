@extends('admin.layouts.admin')

@section('content')


    <h2>Концертные виджеты</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Название</th>
            </thead>
        </tr>
        @foreach($widgets as $widget)
            <tr>
                <td class="city">
                    <a href="{{ route('admin_widgets_edit', ['widget' => $widget->id]) }}" class="table-event-title">{{ $widget->title }}</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $widget->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список виджетов
@endsection

