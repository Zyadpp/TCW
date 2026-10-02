<style>
    .tcw-header { height: 100px; width: min(1300px, calc(100% - 64px)); margin: 0 auto; display: flex; align-items: flex-start; font-family: Arial, sans-serif; }
    .tcw-header__logo { width: 145px; height: 94px; object-fit: contain; }
    .tcw-header__assistant { width: 74px; height: 92px; flex: 0 0 auto; object-fit: cover; object-position: top; }
    .tcw-header__nav { margin-left: 78px; height: 100%; flex: 1; display: flex; align-items: center; justify-content: space-between; gap: 18px; color: #17233a; font-size: 15px; }
    .tcw-header__nav a { white-space: nowrap; text-decoration: none; color: inherit; }
    .tcw-header__nav a.is-active { color: #c59b4d; font-weight: 600; padding-bottom: 9px; border-bottom: 2px solid #c59b4d; }
    .tcw-header__sign-in, .tcw-header__vip { padding: 10px 20px; border-radius: 22px; font-weight: 600; }
    .tcw-header__sign-in { color: #fff !important; background: #c59b4d; }
    .tcw-header__vip { color: #c59b4d !important; border: 1px solid #c59b4d; }
    .tcw-header__flag { width: 25px; height: 17px; margin-left: -7px; object-fit: cover; }
    .tcw-header__logout { border: 1px solid #c59b4d; border-radius: 22px; padding: 10px 18px; background: #fff; color: #c59b4d; cursor: pointer; font: inherit; }
    @media (max-width: 950px) { .tcw-header__nav { margin-left: 28px; gap: 14px; font-size: 13px; } .tcw-header__nav a:nth-child(5), .tcw-header__nav a:nth-child(6), .tcw-header__nav a:nth-child(7) { display: none; } }
    @media (max-width: 620px) { .tcw-header { width: calc(100% - 28px); height: 74px; } .tcw-header__logo { width: 82px; height: 74px; } .tcw-header__assistant { width: 52px; height: 74px; font-size: 20px; } .tcw-header__nav { margin-left: 13px; gap: 9px; font-size: 12px; } .tcw-header__nav a:nth-child(2), .tcw-header__nav a:nth-child(3), .tcw-header__nav a:nth-child(4), .tcw-header__vip { display: none; } .tcw-header__sign-in { padding: 9px 12px; } }
</style>
<header class="tcw-header">
    <a href="{{ route('landing') }}"><img class="tcw-header__logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way"></a>
    <img class="tcw-header__assistant" src="{{ asset('images/tcw-bot.png') }}" alt="TCW assistant">
    <nav class="tcw-header__nav">
        <a class="{{ ($active ?? '') === 'home' ? 'is-active' : '' }}" href="{{ route('landing') }}">Home</a>
        <a class="{{ ($active ?? '') === 'about' ? 'is-active' : '' }}" href="{{ route('about') }}">About us</a>
        <a class="{{ ($active ?? '') === 'projects' ? 'is-active' : '' }}" href="{{ route('projects') }}">Projects</a><a class="{{ ($active ?? '') === 'services' ? 'is-active' : '' }}" href="{{ route('services') }}">Services</a><a class="{{ ($active ?? '') === 'programmes' ? 'is-active' : '' }}" href="{{ route('programmes') }}">Programmes</a><a href="{{ route('landing') }}#stories">Stories</a><a href="{{ route('landing') }}#news">News⌄</a>
        @auth
            <form action="{{ route('logout') }}" method="POST">@csrf <button class="tcw-header__logout" type="submit">Log out</button></form>
        @else
            <a class="tcw-header__sign-in" href="{{ route('admin.login') }}">Sign in</a><a class="tcw-header__vip" href="{{ route('register') }}">Vip community</a>
        @endauth
        <img class="tcw-header__flag" src="{{ asset('images/saudi-flag.jpg') }}" alt="Saudi Arabia">
    </nav>
</header>
<script>
    document.querySelectorAll('.tcw-header__nav a').forEach(function (link) {
        if (link.textContent.trim() === 'Stories') {
            link.href = '{{ route('stories') }}';
            @if (($active ?? '') === 'stories') link.classList.add('is-active'); @endif
        }
        if (link.textContent.trim().indexOf('News') === 0) {
            link.href = '{{ route('news') }}';
            @if (($active ?? '') === 'news') link.classList.add('is-active'); @endif
        }
    });
    window.addEventListener('DOMContentLoaded', function () {
        var footerLinks = {
            'home': '{{ route('landing') }}',
            'about us': '{{ route('about') }}',
            'projects': '{{ route('projects') }}',
            'services': '{{ route('services') }}',
            'programmes': '{{ route('programmes') }}',
            'stories': '{{ route('stories') }}',
            'news': '{{ route('news') }}',
            'vip community': '{{ route('register') }}',
            'our team': '{{ route('team') }}',
            'faq': '{{ route('faq') }}',
            'contact us': '{{ route('contact') }}'
        };
        document.querySelectorAll('footer a').forEach(function (link) {
            var destination = footerLinks[link.textContent.trim().toLowerCase()];
            if (destination) link.href = destination;
        });
    });
</script>
