@extends('admin.layouts.admin', [
    'type'  => 'news',
    'id'    => $news->id
])



@section('content')

    <h2>Редактирование новости от {{ $news->date->format('d.m.Y') }}</h2>

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
        <form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="news_date" class="col-sm-3 col-form-label">Дата</label>
                <div class="col-sm-9">
                    <input
                        type="text"
                        name="date"
                        class="form-control @error('date') is-invalid @enderror"
                        id="news_date"
                        value="{{ $news->date->format('d.m.Y') }}"
                        data-toggle="datepicker"
                    >
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="widget" class="col-sm-3 col-form-label">Виджет с музыкой</label>
                <div class="col-sm-9">
                    <textarea name="widget" class="form-control" id="widget">{{ base64_decode($news->widget) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="news_cover" class="col-sm-3 col-form-label">Картинка к новости</label>
                <div class="col-sm-9 Book__edit-image-box">
                    <a href="{{ asset('storage/NewsImages/'.$news->id.'/cover.jpg') }}" target="_blank"><img src="{{ asset('storage/NewsImages/'.$news->id.'/list.jpg') }}" border="0" style="width:125px; height:auto;" /></a>
                    <input type="file" class="form-control-file" id="news_cover" name="cover" />
                </div>
            </div>
            <div class="form-group row">
                <label for="news_description" class="col-sm-3 col-form-label">Текст</label>
                <div class="col-sm-9">
                    <textarea
                            name="text"
                            class="form-control"
                            id="ckeditor"
                            style="height: 150px;"
                    >{{ $news->text}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="news_is_publish" class="col-sm-3 col-form-label">Публиковать</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="news_is_publish1" value="yes"{{ ($news->is_publish === 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="news_is_publish1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="news_is_publish2" value="no"{{ ($news->is_publish !== 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="news_is_publish2">No</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin.news.delete', $news->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection