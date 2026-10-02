<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>News | TCW</title>
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
            color: #28334c;
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
            background: var(--green);
            color: #fff;
            font-size: 49px;
            font-weight: bold
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            padding-bottom: 54px
        }

        .card {
            overflow: hidden;
            border: 1px solid #e0e2e5;
            border-radius: 12px;
            background: #fff
        }

        .card img {
            width: 100%;
            height: 195px;
            display: block;
            object-fit: cover
        }

        .card-body {
            padding: 15px
        }

        .meta {
            display: flex;
            justify-content: space-between;
            padding-bottom: 14px;
            border-bottom: 1px solid #e4e5e7;
            color: #566079;
            font-size: 11px
        }

        .meta:after {
            content: '';
            position: absolute
        }

        .card h2 {
            min-height: 42px;
            margin: 17px 0 14px;
            font-size: 17px;
            line-height: 1.15
        }

        .card p {
            min-height: 40px;
            margin: 0 0 17px;
            color: #83878d;
            font-size: 12px;
            line-height: 1.35
        }

        .read {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 20px;
            background: #000;
            color: #fff;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none
        }

        .pages {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 22px;
            padding: 0 0 70px
        }

        .pages b {
            display: grid;
            place-items: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--gold);
            color: #fff
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
            background: var(--gold);
            color: #fff
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
            .grid {
                grid-template-columns: repeat(2, 1fr)
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

            .grid {
                grid-template-columns: 1fr
            }

            .card img {
                height: 210px
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

<body>@include('components.site-header',['active'=>'news'])
    @php($articles=[['Launch of Our First Training Courses!','We are proud to introduce the first set of interactive training courses on TCW.'],['Personalized Courses for Your Level!','With TCW’s smart learning system, you can now choose courses based on your current level ..'],['Learn at Your Own Pace!','We offer complete flexibility with on-demand recorded courses available anytime..'],['TCW Community Is Live – Connect & Learn!','We are proud to introduce the first set of interactive training courses on TCW..'],['Earn Certificates for Your Achievements!','We offer complete flexibility with on-demand recorded courses available anytime..'],['Exclusive Live Workshops Coming Soon!','With TCW’s smart learning system, you can now choose courses based on your current level ..'],['New Features to Enhance Your Learning Experience!','We are proud to introduce the first set of interactive training courses on TCW..'],['Personalized Learning is Here!','With TCW’s smart learning system, you can now choose courses based on your current level ..'],['New Instructors, New Courses!','We offer complete flexibility with on-demand recorded courses available anytime..']])
    <main class="container">
        <section class="hero">News</section>
        <section class="grid">@foreach($articles as $index => [$title,$text])<article class="card"><img src="{{ asset('images/news-' . ($index + 1) . '.jpg') }}" alt="{{ $title }}">
                <div class="card-body">
                    <div class="meta"><span>Learning</span><span>October 6, 2024</span></div>
                    <h2>{{ $title }}</h2>
                    <p>{{ $text }}</p><a class="read" href="{{ route('news.details') }}">Read more &nbsp; →</a>
                </div>
            </article>@endforeach</section>
        <nav class="pages"><b>1</b><span>2</span><span>Next &nbsp;→</span></nav>
    </main>
    <section class="newsletter">
        <div class="container">
            <h2>Subscribe Our Newsletter</h2>
            <p>Join now to receive personalized recommendations from the full Coursera catalog.</p>
            <form class="subscribe"><input type="email" placeholder="Enter your mail"><button type="button">Subscribe</button></form>
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
            <h3>Pages</h3><a href="{{ route('programmes') }}">Programmes</a><a href="{{ route('stories') }}">Stories</a><a href="{{ route('news') }}">News</a><a>Vip community</a>
        </div>
        <div>
            <h3>More</h3><a>Our Team</a><a>FAQ</a><a>Contact us</a><a>Shop</a>
        </div>
        <div class="copyright">© {{ date('Y') }} TCW. All rights reserved.</div>
    </footer>
</body>

</html>