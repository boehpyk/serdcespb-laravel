<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <title>SerdceSPb</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<header class="Header container">
    <a href="/" class="Header__logo" title="На главную">
        <img src="/assets/img/logo.png" border="0" />
    </a>
    <div class="Header__address">
        Санкт-Петербург, В.О., Биржевая&nbsp;линия,&nbsp;12
    </div>
    <div class="Header__socials">
        <a href="" title="Telegram"><img src="{{ asset('assets/img/icons/Telegram.png') }}" border="0"></a>
        <a href="" title="Vkontakte"><img src="{{ asset('assets/img/icons/Vkontakte.png') }}" border="0"></a>
        <a href="" title="Facebook"><img src="{{ asset('assets/img/icons/Facebook.png') }}" border="0"></a>
        <a href="" title="YouTube"><img src="{{ asset('assets/img/icons/youtube.png') }}" border="0"></a>
        <a href="" title="Twitter"><img src="{{ asset('assets/img/icons/Twitter.png') }}" border="0"></a>
        <a href="" title="Instagram"><img src="{{ asset('assets/img/icons/instagram.png') }}" border="0"></a>
    </div>
</header>

<nav class="container">
    <ul class="social-networks__container">
        <li @if(isset($dep) && $dep == 'tickets') class="active"@endif>
            <a href="{{ route('index.page') }}" role="listitem" title="Билеты">
                Билеты
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'events') class="active"@endif>
            <a href="{{ route('events.index') }}" role="listitem" title="Афиша">
                Афиша
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'news') class="active"@endif>
            <a href="{{ route('news.index') }}" role="listitem" title="Новости">
                Новости
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'techrider') class="active"@endif>
            <a href="{{ route('text.show', ['slug' => 'techrider']) }}" role="listitem" title="Райдер">
                Райдер
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'gallery') class="active"@endif>
            <a href="{{ route('gallery.index') }}" role="listitem" title="Галерея">
                Галерея
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'services') class="active"@endif>
            <a href="{{ route('text.show', ['slug' => 'services']) }}" role="listitem" title="Услуги">
                Услуги
            </a>
        </li>
        <li @if(isset($dep) && $dep == 'contacts') class="active"@endif>
            <a href="{{ route('text.show', ['slug' => 'contacts']) }}" role="listitem" title="Контакты">
                Контакты
            </a>
        </li>
    </ul>
</nav>

<main class="container">



    @yield('content')




</main>

<video class="video-background" preload="auto" autoplay="true" loop="loop" muted="muted">
    {{--<source src="/assets/video/video.webm" type="video/webm">--}}
    <source src="/assets/video/fon.mp4" type="video/mp4">
    {{--<source src="/assets/video/video.ogv" type="video/ogg ogv">--}}
</video>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>