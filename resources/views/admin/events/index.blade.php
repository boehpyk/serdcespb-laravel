@extends('admin.layouts.admin')

@section('content')


    <h2>{{ $title }}</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Дата</th>
                <th>Город</th>
            </thead>
        </tr>
        @foreach($events as $event)
            <tr>
                <td class="date">
                    {{ $event->date_begin->format('d.m.Y') }}
                </td>
                <td class="city">
                    <a href="{{ route('admin_events_edit', ['event' => $event->id]) }}" class="table-event-title">{{ $event->city }}</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $event->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список концертов
@endsection

