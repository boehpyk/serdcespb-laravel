<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Serdce SPb Admin - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <div class="navbar-brand">Serdce SPb Admin area</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin_index') }}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Выход
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container mt-4">
    <div class="row">
        <aside class="col-sm-3">

            <h4>Концерты</h4>
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <a href="{{ route('admin_events_index') }}">Концерты</a>
                    <ul>
                        <li><a href="{{ route('admin_events_archive') }}">Архив</a></li>
                    </ul>
                </li>
                <li class="list-group-item"><a href="{{ route('admin_events_create') }}">Добавить концерт</a></li>
            </ul>

            <h4>Новости</h4>
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <a href="{{ route('admin.news.index') }}">Новости</a>
                    {{--<ul>--}}
                        {{--<li><a href="{{ route('admin.news.archive') }}">Архив</a></li>--}}
                    {{--</ul>--}}
                </li>
                <li class="list-group-item"><a href="{{ route('admin.news.create') }}">Добавить новость</a></li>
            </ul>
            

            <h4>Карусель</h4>
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <a href="{{ route('admin_carousel_index') }}">Карусель</a>
                </li>
                <li class="list-group-item"><a href="{{ route('admin_carousel_create') }}">Добавить слайд</a></li>
            </ul>


            <h4>Текстовые разделы</h4>
            <ul class="list-group mb-3">
                @foreach ($texts as $text)
                <li class="list-group-item">
                    <a href="{{ route('admin_texts_edit', ['slug' => $text->slug]) }}">{{ $text->title }}</a>
                </li>
                @endforeach
            </ul>




        </aside>
        <div class="col-sm-9 mb-5">



            @yield('content')



        </div>
    </div>
</div>

{{--<script src="{{ asset('js/manifest.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor.js') }}"></script>--}}
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>

@isset($type, $id)
<script type="text/javascript">
    CKEDITOR.replace( 'ckeditor', {
        language: 'ru',
        filebrowserUploadUrl: "{!! route('ckeditor.upload', ['_token' => csrf_token(), 'type' => $type, 'id' => $id ]) !!}",
        filebrowserUploadMethod: 'form',
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        ],
        extraPlugins: 'iframe'
    });
</script>
@endif

</body>

</html>