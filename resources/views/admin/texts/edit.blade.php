@extends('admin.layouts.admin', [
    'type'  => 'text',
    'id'    => $text->id
])


@section('content')

    <h2>Редактирование раздела {{ $text->title }}</h2>

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
        <form action="{{ route('admin_texts_update', ['slug' => $text->slug]) }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row">
                <label for="text_title" class="col-sm-2 col-form-label">Название</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="text_title"
                            value="{{ $text->title }}"
                    >
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                    <input
                            type="text"
                            name="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="title"
                            value="{{ $text->slug }}"
                            placeholder="только латинские буквы и дефис"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Текст</label>
                <div class="col-sm-10">
                        <textarea
                                name="text"
                                class="form-control @error('text') is-invalid @enderror"
                                id="ckeditor"
                        >
                            {{ $text->text }}
                        </textarea>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $text->id }}">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
        <form action="{{ route('admin_texts_delete', ['slug' => $text->slug]) }}" method="post" style="margin-top: -40px;">
            @csrf
            <button type="submit" class="btn btn-danger float-right" data-action="delete">Удалить</button>
        </form>
    </div>

@endsection