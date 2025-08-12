<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <title>SerdceSPb</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon32x32.png" />
</head>

<body>

<div id="fb-root"></div>


<div class="container" id="wrapper">

    <header class="Header">
    <a href="/" class="Header__logo" title="На главную">
        <img src="/assets/img/logo.png" border="0" />
    </a>
    <div class="Header__address">
        Санкт-Петербург, Лиговский пр. 50, к. 16
    </div>
    <div class="Header__socials">
        <a href="https://t.me/serdcespb" title="Telegram" target="_blank"><img src="{{ asset('assets/img/icons/Telegram.png') }}" border="0"></a>
        <a href="https://vk.com/serdcespb" title="Vkontakte" target="_blank"><img src="{{ asset('assets/img/icons/Vkontakte.png') }}" border="0"></a>
        {{--<a href="https://www.facebook.com/serdcespb" title="Facebook" target="_blank"><img src="{{ asset('assets/img/icons/Facebook.png') }}" border="0"></a>--}}
        {{--<a href="" title="YouTube" target="_blank"><img src="{{ asset('assets/img/icons/youtube.png') }}" border="0"></a>--}}
        {{--<a href="" title="Twitter" target="_blank"><img src="{{ asset('assets/img/icons/Twitter.png') }}" border="0"></a>--}}
        {{--<a href="https://www.instagram.com/serdcespb/" title="Instagram" target="_blank"><img src="{{ asset('assets/img/icons/instagram.png') }}" border="0"></a>--}}
    </div>
        <div class="Header__xs-menu" id="show-xs-menu">
            <img src="{{ asset('assets/img/xs-menu.svg') }}" border="0" width="32" height="32">
        </div>
</header>

    <nav>
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
        {{--<li @if(isset($dep) && $dep == 'news') class="active"@endif>--}}
            {{--<a href="{{ route('news.index') }}" role="listitem" title="Новости">--}}
                {{--Новости--}}
            {{--</a>--}}
        {{--</li>--}}
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

    <main>



    @yield('content')


</main>

    {{--<footer>--}}
        {{--<a class="colelem" id="u5200" href="https://vk.com/gooutspb" data-muse-uid="U5200" data-muse-type="img_frame">--}}
            {{--<img class="block" id="u5200_img" src="{{ asset('assets/img/gooutspb.jpg') }}"/>--}}
        {{--</a>--}}
        {{--<a class="colelem" id="u15367" href="https://vk.com/svetskayazhiznnaneve" data-muse-uid="U15367" data-muse-type="img_frame">--}}
            {{--<img class="block" id="u15367_img" src="{{ asset('assets/img/sv-life.jpg') }}"/>--}}
        {{--</a>--}}
        {{--<div class="colelem" id="u4991"><!-- custom html -->--}}
            {{--<div class="fb-like" data-href="http://serdcespb.ru/" data-send="false" data-width="225" data-show-faces="false" data-colorscheme="light" data-layout="standard" data-action="like"></div>--}}
        {{--</div>--}}
        {{--<a class="nonblock nontext clip_frame colelem" id="u7833" href="http://www.gorodovoy.spb.ru/" data-muse-uid="U7833" data-muse-type="img_frame">--}}
            {{--<img class="block" id="u7833_img" src="{{ asset('assets/img/gorodovoy.jpg') }}"/>--}}
        {{--</a>--}}
        {{--<div class="colelem" id="u2045">--}}
            {{--<!--LiveInternet counter-->--}}
            {{--<script type="text/javascript"><!----}}
                {{--document.write("<a href='//www.liveinternet.ru/click' "+--}}
                    {{--"target=_blank><img src='//counter.yadro.ru/hit?t18.2;r"+--}}
                    {{--escape(document.referrer)+((typeof(screen)=="undefined")?"":--}}
                        {{--";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?--}}
                        {{--screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+--}}
                    {{--";"+Math.random()+--}}
                    {{--"' alt='' title='LiveInternet: показано число просмотров за 24"+--}}
                    {{--" часа, посетителей за 24 часа и за сегодня' "+--}}
                    {{--"border='0' width='88' height='31'><\/a>")--}}
                {{--//--></script>--}}
            {{--<!--/LiveInternet-->--}}
        {{--</div>--}}
    {{--</footer>--}}

</div>

<video class="video-background" preload="auto" autoplay="true" loop="loop" muted="muted">
    {{--<source src="/assets/video/video.webm" type="video/webm">--}}
    <source src="/assets/video/fon.mp4" type="video/mp4">
    {{--<source src="/assets/video/video.ogv" type="video/ogg ogv">--}}
</video>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
