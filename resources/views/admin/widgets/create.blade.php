@extends('admin.layouts.admin')

@section('content')


    <h2>Добавление виджета</h2>

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
            <form action="{{ route('admin_widgets_store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="date_begin" class="col-sm-2 col-form-label">Название</label>
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
                    <label for="city" class="col-sm-2 col-form-label">Код виджета</label>
                    <div class="col-sm-10">
                        <textarea name="code" class="form-control" style="height: 250px;">{{ old('code') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>


@endsection

@section('title')
    Добавление виджета
@endsection

