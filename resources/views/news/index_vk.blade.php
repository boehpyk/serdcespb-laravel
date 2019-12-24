@extends('layouts.app', ['dep' => 'news'])

@section('content')

<h1>Новости</h1>

<section class="News">

    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

    <!-- VK Widget -->
    <div id="vk_groups"></div>
    <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 4, width: "920", height: "800", color1: '070707', color2: 'FCFCFC', color3: 'DF543F'}, 135148155);
    </script>

</section>
@endsection