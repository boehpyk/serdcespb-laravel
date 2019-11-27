@extends('admin.layouts.admin')


@section('content')

    <h2>Редактирование виджета</h2>

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
        <form action="{{ route('admin_widgets_update', $widget->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="date_begin" class="col-sm-2 col-form-label">Название</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            value="{{ $widget->title }}"
                    >
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Код виджета</label>
                <div class="col-sm-10">
                    <textarea name="code" class="form-control" style="height: 250px;">{{ base64_decode($widget->code) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="widget_is_publish" class="col-sm-2 col-form-label">Публиковать</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="widget_is_publish1" value="yes"{{ ($widget->is_publish === 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="widget_is_publish1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="widget_is_publish2" value="no"{{ ($widget->is_publish !== 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="widget_is_publish2">No</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin_widgets_delete', $widget->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection