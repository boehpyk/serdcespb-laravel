@extends('admin.layouts.admin')


@section('content')

    <h2>Редактирование слайда</h2>

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
        <form action="{{ route('admin_carousel_update', $slide->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="date_begin" class="col-sm-2 col-form-label">Дата</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="date_begin"
                            class="form-control @error('date_begin') is-invalid @enderror"
                            id="date_begin"
                            value="{{ $slide->date_begin->format('d.m.Y') }}"
                            data-toggle="datepicker"
                    >
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Название</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title"
                            value="{{ $slide->title }}"
                    >
                </div>
            </div>

            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label">Ссылка</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="url"
                            class="form-control @error('url') is-invalid @enderror"
                            id="url"
                            value="{{ $slide->url }}"
                    >
                </div>
            </div>

            <div class="form-group row">
                <label for="event_cover" class="col-sm-3 col-form-label">Картинка</label>
                <div class="col-sm-9 Book__edit-image-box">
                    <a href="{{ asset('storage/CarouselImages/'.$slide->image) }}" target="_blank"><img src="{{ asset('storage/CarouselImages/'.$slide->image) }}" border="0" style="width:125px; height:auto;" /></a>
                    <input type="file" class="form-control-file" id="event_cover" name="cover" />
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin_carousel_delete', $slide->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection