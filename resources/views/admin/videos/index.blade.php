@extends('admin.layouts.admin')

@section('content')


    <h2>Видео</h2>

    <form action="{{ route('admin_videos_update') }}" method="post" id="videosUpdate">

        @csrf

    <table class="table table-bordered table-sm Events__list-table">
        <tr>
            <thead>
                <th>&nbsp;</th>
                <th>Название</th>
                <th style="width: 50px;"> </th>
                <th style="width: 50px;"> </th>
            </thead>
        </tr>
        @foreach($videos as $video)
            <tr>
                <td style="width: 140px;">
                    <img src="https://i.ytimg.com/vi/{{ $video->code }}/default.jpg" border="0" />
                </td>
                <td class="city">
                    {{ $video->title }}
                </td>
                <td>
                    <div class="custom-control custom-switch">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customSwitch{{ $video->id }}"
                            name="is_publish[{{ $video->id }}]"
                            value="yes"
                            {{ ($video->is_publish === 'yes') ? 'checked' : '' }}
                        >
                        <label class="custom-control-label" for="customSwitch{{ $video->id }}">Публиковать</label>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input
                            type="checkbox"
                            class="custom-control-input delete"
                            name="delete[{{ $video->id }}]"
                            id="delete[{{ $video->id }}]"
                            value="yes"
                        >
                        <label class="custom-control-label" for="delete[{{ $video->id }}]">Удалить</label>
                    </div>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $video->id }}]">
            </tr>
        @endforeach
    </table>

    <button type="submit" class="btn btn-primary">Внести изменения</button>

    </form>

@endsection

@section('title')
    Список видео
@endsection

