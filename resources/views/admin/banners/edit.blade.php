@extends('admin.layouts.admin')


@section('content')

    <h2>Редактирование баннера</h2>

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
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="date_begin" class="col-sm-2 col-form-label">Ссылка</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="url"
                            class="form-control @error('url') is-invalid @enderror"
                            id="url"
                            value="{{ $banner->url }}"
                    >
                    @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="event_cover" class="col-sm-3 col-form-label">Картинка</label>
                <div class="col-sm-9 Book__edit-image-box">
                    <img src="{{ asset('storage/BannerImages/' . $banner->image) }}" border="0" style="width:125px; height:auto;" />
                    <input type="file" class="form-control-file" id="event_cover" name="image" />
                </div>
            </div>

            <div class="form-group row">
                <label for="banner_is_publish" class="col-sm-2 col-form-label">Публиковать</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="banner_is_publish1" value="yes"{{ ($banner->is_publish === 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="banner_is_publish1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_publish" id="banner_is_publish2" value="no"{{ ($banner->is_publish !== 'yes') ? ' checked' : '' }}>
                        <label class="form-check-label" for="banner_is_publish2">No</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin.banners.delete', $banner->id) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection