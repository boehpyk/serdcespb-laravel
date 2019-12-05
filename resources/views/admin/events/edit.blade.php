@extends('admin.layouts.admin')


@section('content')

    <h2>Редактирование концерта {{ $event->date_begin->format('d.m.Y') }} {{ $event->city }}</h2>

    <div class="container mt-5 Events__edit-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin_events_update', $event->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="event_city" class="col-sm-3 col-form-label">Город</label>
                <div class="col-sm-9">
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="event_city" value="{{ $event->city }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="event_date_begin" class="col-sm-3 col-form-label">Дата</label>
                <div class="col-sm-9">
                    <input
                        type="text"
                        name="date_begin"
                        class="form-control @error('date_begin') is-invalid @enderror"
                        id="event_date_begin"
                        value="{{ $event->date_begin->format('d.m.Y') }}"
                        data-toggle="datepicker"
                    >
                    @error('date_begin')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="event_date_end" class="col-sm-3 col-form-label">Вторая дата для фестов <small>(необязательно)</small></label>
                <div class="col-sm-9">
                    <input
                        type="text"
                        name="date_end"
                        class="form-control @error('date_end') is-invalid @enderror"
                        id="event_date_end"
                        value="{{ $event->date_end }}"
                        data-toggle="datepicker"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="event_info" class="col-sm-3 col-form-label">Доп. инфо о концерте <small>(типа "акустика в полном составе" или "фестиваль Нашествие")</small></label>
                <div class="col-sm-9">
                    <input type="text" name="info" class="form-control" id="event_info" value="{{ $event->info }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="event_tickets_url" class="col-sm-3 col-form-label">Продажа билетов</label>
                <div class="col-sm-9">
                    <textarea name="tickets_url" class="form-control" id="event_tickets_url">{{ base64_decode($event->tickets_url) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="event_club_name" class="col-sm-3 col-form-label">Название площадки</label>
                <div class="col-sm-9">
                    <input type="text" name="club_name" class="form-control" id="event_club_name" value="{{ $event->club_name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="event_club_url" class="col-sm-3 col-form-label">Сайт площадки</label>
                <div class="col-sm-9">
                    <input type="text" name="club_url" class="form-control" id="event_club_url" value="{{ $event->club_url }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="event_meeting_url" class="col-sm-3 col-form-label">Ссылка на встречу</label>
                <div class="col-sm-9">
                    <input type="text" name="meeting_url" class="form-control" id="event_meeting_url" value="{{ $event->meeting_url }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="event_cover" class="col-sm-3 col-form-label">Картинка афиши</label>
                <div class="col-sm-9 Book__edit-image-box">
                    <a href="{{ asset('storage/EventImages/'.$event->id.'/cover.jpg') }}" target="_blank"><img src="{{ asset('storage/EventImages/'.$event->id.'/cover.jpg') }}" border="0" style="max-width: 200px" /></a>
                    <input type="file" class="form-control-file" id="event_cover" name="cover" />
                </div>
            </div>
            <div class="form-group row">
                <label for="event_description" class="col-sm-3 col-form-label">Дополнительно</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" id="event_description" style="height: 150px;">{{ $event->description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="event_is_publish" class="col-sm-3 col-form-label">Публиковать</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="event_is_publish1" value="yes"{{ ($event->is_publish === 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="event_is_publish1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="event_is_publish2" value="no"{{ ($event->is_publish !== 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="event_is_publish2">No</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin_events_delete', $event->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection