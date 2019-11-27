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

    <section id="concerts"></section>


    @if (count($widgets) > 0)
        <h2>Билеты</h2>

        @foreach($widgets as $widget)
            <section class="widget">
                {!! base64_decode($widget->code) !!}
            </section>
        @endforeach

    @endif

    <iframe
            class="video"
            ref="frame"
            src="https://www.youtube.com/embed/lv1410Zk4Yo?autoplay=0"
            width="100%"
            height="400"
            frameborder="0"
    ></iframe>
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

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
