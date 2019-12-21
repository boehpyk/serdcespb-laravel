@extends('admin.layouts.admin')

@section('content')

    <h2>Редактирование фотогалереи &laquo;{{ $gallery->title }}&raquo;</h2>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="{{ route('admin.galleries.edit', ['gallery' => $gallery->id]) }}" class="nav-link">Параметры</a>
        </li>
        <li class="nav-item">
            <div class="nav-link active">Фотографии</div>
        </li>
    </ul>

    <div class="Photo__add">
        <h5>Добавить фото (можно сразу много)</h5>
        <form
            action="{{ route('admin.galleries.photos.add', ['gallery' => $gallery->id]) }}"
            method="post"
            id="photosAdd"
            enctype="multipart/form-data"
        >
            @csrf

            <input type="file" name="photos[]" multiple />
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

    <h4>Список фото</h4>

    <form action="{{ route('admin.galleries.photos.update', ['gallery' => $gallery->id]) }}" method="post" id="photosUpdate">

        @csrf

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>&nbsp;</th>
                <th>Название</th>
                <th style="width: 50px;">Публиковать</th>
                <th style="width: 50px;">Удалить</th>
            </thead>
        </tr>
        @foreach($photos as $photo)
            <tr>
                <td style="width: 140px;">
                    <img src="{{ asset('storage/GalleryFiles/' . $gallery->id . '/' . $photo->thumb) }}" border="0" />
                </td>
                <td class="city">
                    <input type="text" name="title[{{ $photo->id }}]" class="form-control" value="{{ $photo->title }}" />
                </td>
                <td>
                    <input
                        type="checkbox"
                        class="form-control"
                        id="customSwitch{{ $photo->id }}"
                        name="is_publish[{{ $photo->id }}]"
                        value="yes"
                        data-type="is_publish"
                        {{ ($photo->is_publish === 'yes') ? 'checked' : '' }}
                    >
                </td>
                <td>
                    <input
                        type="checkbox"
                        class="form-control delete"
                        name="delete[{{ $photo->id }}]"
                        id="delete[{{ $photo->id }}]"
                        value="yes"
                        data-type="delete"
                    >
                </td>
                <input type="hidden" value="yes" name="exists[{{ $photo->id }}]">
            </tr>
        @endforeach
        <tr>
            <td colspan="2"> </td>
            <td>
                <input type="checkbox" class="form-control" data-select="is_publish" id="is_publish_all" />
                <label for="is_publish_all">все</label>
            </td>
            <td>
                <input type="checkbox" class="form-control" data-select="delete" id="delete_all" />
                <label for="delete_all">все</label>
            </td>
        </tr>
    </table>

    <button type="submit" class="btn btn-primary">Внести изменения</button>

    </form>

@endsection

@section('title')
    Список фото
@endsection

