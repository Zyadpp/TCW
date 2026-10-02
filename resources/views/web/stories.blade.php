<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Stories | TCW</title>
    <style>
        :root {
            --green: #176047;
            --gold: #c59b4d;
            --soft: #f1f8f5
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            color: #252a31;
            font: 14px Arial, sans-serif
        }

        .container {
            width: min(1150px, calc(100% - 64px));
            margin: auto
        }

        .hero {
            height: 210px;
            display: grid;
            place-items: center;
            margin: 22px auto 63px;
            border-radius: 18px;
            color: #fff;
            background: var(--green);
            font-size: 49px;
            font-weight: bold
        }

        .stories {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            padding-bottom: 72px
        }

        .story {
            position: relative;
            overflow: hidden;
            height: 312px;
            border-radius: 7px;
            background: #ddd
        }

        .story img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            transition: transform .25s
        }

        .story:hover img {
            transform: scale(1.04)
        }

        .views {
            position: absolute;
            bottom: 17px;
            left: 18px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-shadow: 0 1px 4px #000
        }

        .newsletter {
            padding: 65px 0;
            background: var(--soft)
        }

        .newsletter h2 {
            margin: 0 0 12px;
            color: var(--green);
            font-size: 27px
        }

        .newsletter p {
            max-width: 490px;
            color: #66716e;
            font-size: 15px;
            line-height: 1.45
        }

        .subscribe {
            display: flex;
            width: 370px;
            max-width: 100%;
            height: 46px;
            margin-top: 24px
        }

        .subscribe input {
            flex: 1;
            min-width: 0;
            padding: 0 16px;
            border: 1px solid #ddd;
            border-radius: 10px 0 0 10px
        }

        .subscribe button {
            border: 0;
            padding: 0 22px;
            border-radius: 0 10px 10px 0;
            color: #fff;
            background: var(--gold)
        }

        footer {
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 35px;
            padding: 57px 0 25px;
            color: #777
        }

        footer img {
            width: 180px;
            height: 105px;
            object-fit: contain
        }

        footer h3 {
            margin: 13px 0 18px;
            color: #333;
            font-size: 16px
        }

        footer p,
        footer a {
            display: block;
            margin: 8px 0;
            color: #777;
            line-height: 1.5;
            text-decoration: none
        }

        .copyright {
            grid-column: 1/-1;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px
        }

        @media(max-width:850px) {
            .stories {
                grid-template-columns: repeat(3, 1fr)
            }

            footer {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:560px) {
            .container {
                width: calc(100% - 30px)
            }

            .hero {
                height: 135px;
                margin-bottom: 40px;
                font-size: 36px
            }

            .stories {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                padding-bottom: 45px
            }

            .story {
                height: 220px
            }

            .newsletter {
                padding: 45px 0
            }

            footer>div:first-child {
                grid-column: 1/-1
            }
        }
    </style>
</head>

<body>
    @include('components.site-header', ['active' => 'stories'])
    <main class="container">
        <section class="hero">Stories</section>
        <section class="stories">@for($story = 1; $story <= 12; $story++)<a class="story" href="#" aria-label="Watch story"><img src="{{ asset('images/story-' . $story . '.jpg') }}" alt="TCW learning story"><span class="views">▶&nbsp; 70</span></a>@endfor</section>
    </main>
    <section class="newsletter">
        <div class="container">
            <h2>Subscribe Our Newsletter</h2>
            <p>Join now to receive personalized recommendations from the full Coursera catalog.</p>
            <form class="subscribe"><input type="email" placeholder="Enter your mail" aria-label="Email"><button type="button">Subscribe</button></form>
        </div>
    </section>
    <footer class="container">
        <div><img src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <p>Join now to get personalized course recommendations from TCW’s exclusive learning catalog!</p>
        </div>
        <div>
            <h3>Contact us</h3>
            <p>+980 385 6532<br>+758 6987 265<br>info@tcw.com</p>
        </div>
        <div>
            <h3>Company</h3><a href="{{ route('landing') }}">Home</a><a href="{{ route('about') }}">About us</a><a href="{{ route('projects') }}">Projects</a><a href="{{ route('services') }}">Services</a>
        </div>
        <div>
            <h3>Pages</h3><a href="{{ route('programmes') }}">Programmes</a><a href="{{ route('stories') }}">Stories</a><a>News</a><a>Vip community</a>
        </div>
        <div>
            <h3>More</h3><a>Our Team</a><a>FAQ</a><a>Contact us</a><a>Shop</a>
        </div>
        <div class="copyright">© {{ date('Y') }} TCW. All rights reserved.</div>
    </footer>
</body>

</html>
