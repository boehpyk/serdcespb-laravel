<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
    <link rel="icon" type="image/x-icon" href="favicon.png" />
    <title>Zero People</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                                <a href="{{ $event->club_url }}">
                            @else
                            <a href="{{ $event->meeting_url }}">
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

</body>
</html>
