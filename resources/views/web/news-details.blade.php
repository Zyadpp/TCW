<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>News details | TCW</title>
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
            margin: 22px auto 76px;
            border-radius: 18px;
            background: var(--green);
            color: #fff;
            font-size: 49px;
            font-weight: bold
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            gap: 28px;
            min-height: 760px;
            padding-bottom: 75px
        }

        .article>img {
            width: 100%;
            height: 330px;
            border-radius: 12px;
            object-fit: cover
        }

        .meta {
            display: flex;
            justify-content: space-between;
            margin: 16px 0 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid #ddd;
            color: #566079
        }

        .article h1 {
            margin: 0 0 18px;
            font-size: 26px
        }

        .article p {
            color: #596174;
            font-size: 16px;
            line-height: 1.5
        }

        .article h2 {
            margin: 32px 0 18px;
            font-size: 20px
        }

        .article li {
            margin: 15px 0;
            color: #3e4962
        }

        .recent {
            padding: 24px;
            border-radius: 12px;
            background: #fafafa
        }

        .recent h2 {
            margin: 3px 0 24px;
            font-size: 16px
        }

        .mini {
            overflow: hidden;
            margin-bottom: 18px;
            border: 1px solid #e1e2e5;
            border-radius: 12px;
            background: #fff
        }

        .mini img {
            width: 100%;
            height: 155px;
            display: block;
            object-fit: cover
        }

        .mini div {
            padding: 14px
        }

        .mini small {
            display: flex;
            justify-content: space-between;
            padding-bottom: 13px;
            border-bottom: 1px solid #ddd;
            color: #596174
        }

        .mini h3 {
            font-size: 16px
        }

        .mini p {
            color: #7c8089;
            line-height: 1.35
        }

        .read {
            display: inline-block;
            padding: 9px 16px;
            border-radius: 20px;
            background: #000;
            color: #fff;
            font-size: 11px;
            text-decoration: none
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
            .layout {
                grid-template-columns: 1fr
            }

            .recent-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px
            }

            .mini {
                margin: 0
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
                margin-bottom: 45px;
                font-size: 36px
            }

            .article>img {
                height: 220px
            }

            .recent-list {
                grid-template-columns: 1fr
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
    <main class="container">
        <section class="hero">News details</section>
        <section class="layout">
            <article class="article"><img src="{{ asset('images/news-1.jpg') }}" alt="Launch of Our First Training Courses">
                <div class="meta"><span>Learning</span><span>October 6, 2024</span></div>
                <h1>Launch of Our First Training Courses!</h1>
                <p>We are proud to introduce the first set of interactive training courses on TCW! These courses are designed to provide an engaging and effective learning experience, helping users develop new skills and advance in their careers.</p>
                <h2>What to Expect?</h2>
                <ul>
                    <li>Expert-Led Courses – Learn from industry professionals with hands-on experience.</li>
                    <li>Interactive Content – Enjoy quizzes, case studies, and real-world applications.</li>
                    <li>Flexible Learning – Study at your own pace with on-demand access.</li>
                    <li>Certification – Earn official certificates upon course completion.</li>
                </ul>
            </article>
            <aside class="recent">
                <h2>Recent Courses</h2>
                <div class="recent-list">@foreach([2,3] as $number)<article class="mini"><img src="{{ asset('images/news-' . $number . '.jpg') }}" alt="Recent news">
                        <div><small><span>Learning</span><span>October 6, 2024</span></small>
                            <h3>{{ $number === 2 ? 'Personalized Courses for Your Level!' : 'Learn at Your Own Pace!' }}</h3>
                            <p>With TCW’s smart learning system, you can now choose courses based on your current level ..</p><a class="read" href="{{ route('news.details') }}">Read more &nbsp;→</a>
                        </div>
                    </article>@endforeach</div>
            </aside>
        </section>
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