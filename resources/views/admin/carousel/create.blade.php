@extends('admin.layouts.admin')

@section('content')


    <h2>Добавление слайда в карусель</h2>

    @if ($errors->any())
        <div class="alert alert-danger mt-4 mb4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-4">
        <div class="col-sm-9">
            <form action="{{ route('admin_carousel_store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="date_begin" class="col-sm-2 col-form-label">Дата</label>
                    <div class="col-sm-10">
                        <input
                                type="text"
                                name="date_begin"
                                class="form-control @error('date_begin') is-invalid @enderror"
                                id="date_begin"
                                value="{{ old('date_begin') }}"
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
                                value="{{ old('title') }}"
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
                                value="{{ old('url') }}"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slide_cover" class="col-sm-3 col-form-label">Картинка</label>
                    <div class="col-sm-9 Book__edit-image-box">
                        <input type="file" class="form-control-file" id="slide_cover" name="cover" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>


@endsection

@section('title')
    Добавление видео
@endsection

