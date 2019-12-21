@extends('admin.layouts.admin')

@section('content')


    <h2>Баннеры</h2>

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>Название</th>
            </thead>
        </tr>
        @foreach($banners as $banner)
            <tr>
                <td class="city">
                    <a href="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}" class="table-event-title">
                        <img src="{{ asset('storage/BannerImages/' . $banner->image) }}" border="0" style="width:125px; height:auto;" />
                    </a>
                </td>
                <td>
                    <a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $banner->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список баннеров
@endsection

