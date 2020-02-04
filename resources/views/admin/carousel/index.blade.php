@extends('admin.layouts.admin')

@section('content')


    <h2>Список слайдов карусели</h2>

    <table class="table table-bordered table-sm Events__list-table">
        @foreach($slides as $slide)
            <tr>
                <td class="title">
                    <a href="{{ route('admin_carousel_edit', ['slide' => $slide->id]) }}" class="table-slide-title">
                        <img src="{{ asset('storage/CarouselImages/'.$slide->image) }}" border="0" style="width:auto; height:auto;" />
                    </a>
                </td>
                <input type="hidden" value="yes" name="exists[{{ $slide->id }}]">
            </tr>
        @endforeach
    </table>

@endsection

@section('title')
    Список слайдов карусели
@endsection

