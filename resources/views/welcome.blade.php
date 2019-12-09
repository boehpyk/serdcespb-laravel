<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <title>Zero People</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Zero People" />
    <meta property="og:description" content="Zero People - сайд-проект музыкантов Animal ДжаZ Александра Красовицкого и Александра Заранкина" />
    <meta property="og:url" content="https://zeropeople.ru/" />
    <meta property="og:image" content="https://zeropeople.ru/assets/zeropeople.jpg" />
</head>

<body>
<header class="header">
    <div class="container">
        <h1>Zero People</h1>
    </div>
</header>

<nav class="social-networks">
    <ul class="social-networks__container">
        <li>
            <a class="social-link" target="_blank" href="https://vk.com/zero_people" role="listitem" title="Вконтакте">
                <img src="{{ asset('assets/icons/vk.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="https://www.facebook.com/zeropeopleband/" role="listitem" title="Facebook">
                <img src="{{ asset('assets/icons/facebook.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="https://www.instagram.com/zeropeopleband/" role="listitem" title="Instagram">
                <img src="{{ asset('assets/icons/instagram.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="http://www.twitter.com/zero_people" role="listitem" title="Twitter">
                <img src="{{ asset('assets/icons/twitter.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="https://www.youtube.com/user/zeropeopleband" role="listitem" title="YouTube">
                <img src="{{ asset('assets/icons/youtube.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="https://music.apple.com/ru/artist/zero-people/912495669?l=ru" role="listitem" title="ITunes">
                <img src="{{ asset('assets/icons/itunes.svg') }}" border="0" />
            </a>
        </li>
        <li>
            <a class="social-link" target="_blank" href="https://play.google.com/store/music/artist/Zero_People?id=Afme4uzdwxfnfy2qguprwvktrou&hl=ru_RU" role="listitem" title="Google Play">
                <img src="{{ asset('assets/icons/google-play.svg') }}" border="0" />
            </a>
        </li>
    </ul>
</nav>

<main class="container">
    <h2>Концерты</h2>

    <section id="concerts">
        <ul class='concert-list'>
        @foreach($events as $event)
            @php
                $tickets_url = base64_decode($event->tickets_url)
            @endphp
            <li class='concert-list-item'>
                <div class='concert-card'>
                    <div class='concert-date'>
                        <span>{{ \Carbon\Carbon::parse($event->date_begin)->format('d.m.Y') }}</span>
                    </div>
                    <div class='concert-body'>
                        <h3 class='concert-city'>
                            <a href="{{ $event->meeting_url }}" target="_blank" title="{{ $event->city }} {{ \Carbon\Carbon::parse($event->date_begin)->format('d.m.Y') }}">{{ $event->city }}</a>
                        </h3>
                        <p class='concert-place'>
                            @if (strlen($event->club_url) > 0)
                                <a href="{{ $event->club_url }}" target="_blank">
                            @else
                            <a href="{{ $event->meeting_url }}" target="_blank">
                            @endif
                            {{ $event->club_name }}
                            </a>
                        </p>
                        <div class="concert-tickets">
                            @if (strpos($tickets_url, "http://") === 0 || (strpos($tickets_url, "https://") === 0))
                                <a href="{{ $tickets_url }}" target="_blank" class="buy-ticket">Купить билет</a>
                            @endif
                            @if (strpos($tickets_url, "<script") === 0)
                                {!! $tickets_url !!}
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>

        {{--<div class='concert-list-preloader'>--}}
            {{--<div class="preloader"></div>--}}
        {{--</div>--}}
    </section>


    @if (count($widgets) > 0)
        <h2>Билеты</h2>

        @foreach($widgets as $widget)
            <section class="widget">
                {!! base64_decode($widget->code) !!}
            </section>
        @endforeach

    @endif

    @if (count($videos) > 0)
        @foreach($videos as $video)
            <iframe
                    class="video"
                    ref="frame"
                    src="https://www.youtube.com/embed/{{ $video->code }}?autoplay=0"
                    width="100%"
                    height="400"
                    frameborder="0"
            ></iframe>
        @endforeach
    @endif


</main>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <p class="contact">
                <span>Booking:</span>
                <a href="https://vk.com/zarankin" target="_blank">Александр Заранкин</a>
                <a href="tel:+79110922882">+7 911 092-28-82</a>
                <a href="mailto:zarankin@bk.ru?subject=Организация концерта Zero People">zarankin@bk.ru</a>
            </p>

            <p class="contact">
                <span>PR:</span>
                <a href="https://vk.com/marygoldpr">Мария Минина</a>
                <a href="tel:+79032165576">+7 903 216-55-76</a>
                <a href="mailto:marygoldpr@gmail.com?subject=Zero People">marygoldpr@gmail.com</a>
            </p>

            <p class="context">Zero People 2019</p>
        </div>
    </div>
</footer>

{{--<script src="{{ asset('js/manifest.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor.js') }}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>

<!-- VK pixel -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?162",t.onload=function(){VK.Retargeting.Init("VK-RTRG-434118-5CDq3"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-434118-5CDq3" style="position:fixed; left:-999px;" alt=""/></noscript>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(56547103, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/56547103" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-67021517-8"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-67021517-8');
</script>

</body>
</html>
