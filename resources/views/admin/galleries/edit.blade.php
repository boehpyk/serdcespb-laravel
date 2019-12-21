@extends('admin.layouts.admin', [
    'type'  => 'gallery',
    'id'    => $gallery->id
])



@section('content')



    <h2>Редактирование фотогалереи {{ $gallery->title }}</h2>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <div class="nav-link active">Параметры</div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.galleries.photos.list', ['gallery' => $gallery->id]) }}">Фотографии</a>
        </li>
    </ul>
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
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="gallery_title" class="col-sm-3 col-form-label">Название</label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="gallery_title" value="{{ $gallery->title }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="gallery_description" class="col-sm-3 col-form-label">Дополнительно</label>
                <div class="col-sm-9">
                    <textarea
                            name="description"
                            class="form-control"
                            id="ckeditor"
                    >
                        {{ $gallery->description }}
                    </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="gallery_is_publish" class="col-sm-3 col-form-label">Публиковать</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="gallery_is_publish1" value="yes"{{ ($gallery->is_publish === 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="gallery_is_publish1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="gallery_is_publish2" value="no"{{ ($gallery->is_publish !== 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="gallery_is_publish2">No</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

        <form action="{{ route('admin.galleries.delete', $gallery->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection