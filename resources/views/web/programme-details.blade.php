<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCWTIR Programme | TCW</title>
    <style>
        :root {
            --green: #176047;
            --gold: #c59b4d;
            --soft: #f1f8f5;
            --ink: #252a31;
            --muted: #77807e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--ink);
            font: 14px Arial, sans-serif;
        }

        .container {
            width: min(1150px, calc(100% - 64px));
            margin: auto;
        }

        .programme-hero {
            min-height: 230px;
            margin: 22px auto 75px;
            padding: 42px 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 18px;
            color: white;
            background: var(--green);
        }

        .programme-hero h1 {
            margin: 0 0 18px;
            font-size: 48px;
            letter-spacing: .5px;
        }

        .programme-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            color: #c6ddd3;
            font-size: 15px;
        }

        .programme-meta span+span::before {
            content: '•';
            margin-right: 12px;
        }

        .hero-action {
            min-width: 145px;
            text-align: center;
        }

        .member-count {
            margin-bottom: 17px;
            color: #c6ddd3;
            font-size: 15px;
        }

        .hero-price {
            margin-bottom: 19px;
            font-size: 27px;
            font-weight: bold;
        }

        .gold-button,
        .dark-button {
            display: inline-block;
            border: 0;
            border-radius: 22px;
            padding: 11px 28px;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            background: var(--gold);
        }

        .content {
            padding-bottom: 76px;
        }

        .content>h2 {
            margin: 0 0 24px;
            font-size: 28px;
        }

        .details-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            gap: 28px;
            align-items: start;
        }

        .details-card,
        .recommendations {
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 13px 30px #142e2010;
        }

        .details-card {
            padding: 24px;
        }

        .cover {
            position: relative;
            overflow: hidden;
            height: 300px;
            border-radius: 10px;
            background: #3d3021;
        }

        .cover img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .cover:after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #00000014, transparent 65%);
        }

        .card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 17px 2px;
            color: #8c816c;
        }

        .card-meta span+span::before {
            content: '•';
            margin-right: 12px;
            color: var(--gold);
        }

        .course-intro {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px;
        }

        .course-intro h3 {
            margin: 2px 0 14px;
            font-size: 20px;
        }

        .course-intro p {
            max-width: 560px;
            margin: 0 0 12px;
            color: #5f6366;
            line-height: 1.45;
        }

        .course-buy {
            min-width: 120px;
            text-align: right;
        }

        .course-buy strong {
            display: block;
            margin: 0 0 18px;
            font-size: 25px;
        }

        .dark-button {
            padding: 10px 22px;
            background: #050505;
            font-size: 12px;
        }

        .learn {
            margin: 26px 0 24px;
        }

        .learn h3 {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .learn ul {
            padding: 0;
            margin: 0;
            list-style: none;
            color: #656a6c;
            line-height: 2;
        }

        .learn li::before {
            content: '✓';
            display: inline-grid;
            width: 16px;
            height: 16px;
            place-items: center;
            margin-right: 8px;
            border: 1px solid #d2a75f;
            border-radius: 50%;
            color: #c59b4d;
            font-size: 10px;
        }

        .cta {
            position: relative;
            overflow: hidden;
            min-height: 192px;
            padding: 36px 30px;
            border-radius: 13px;
            color: #fff;
            background: linear-gradient(90deg, #1c0c42d9, #28103f88), url('https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=85') center/cover;
        }

        .cta h3 {
            max-width: 270px;
            margin: 0 0 13px;
            font-size: 27px;
            line-height: 1.12;
        }

        .cta p {
            max-width: 270px;
            margin: 0 0 17px;
            line-height: 1.35;
        }

        .cta .gold-button {
            color: #1c1c1c;
            background: #fff;
        }

        .recommendations {
            min-height: 620px;
            padding: 24px;
            background: #fafafa;
        }

        .recommendations h3 {
            margin: 2px 0 24px;
            font-size: 16px;
        }

        .mini-course {
            overflow: hidden;
            margin-bottom: 20px;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 8px 17px #142e2018;
        }

        .mini-course img {
            width: 100%;
            height: 113px;
            display: block;
            object-fit: cover;
        }

        .mini-body {
            padding: 11px;
        }

        .mini-title {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 12px;
        }

        .mini-info {
            margin: 10px 0;
            color: #9b8a6c;
            font-size: 9px;
        }

        .mini-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #777;
            font-size: 9px;
        }

        .mini-bottom .dark-button {
            padding: 6px 10px;
            font-size: 8px;
        }

        .newsletter {
            padding: 65px 0;
            background: var(--soft);
        }

        .newsletter h2 {
            margin: 0 0 12px;
            color: var(--green);
            font-size: 27px;
        }

        .newsletter p {
            max-width: 490px;
            color: #66716e;
            font-size: 15px;
            line-height: 1.45;
        }

        .subscribe {
            display: flex;
            width: 370px;
            max-width: 100%;
            height: 46px;
            margin-top: 24px;
        }

        .subscribe input {
            flex: 1;
            min-width: 0;
            padding: 0 16px;
            border: 1px solid #ddd;
            border-radius: 10px 0 0 10px;
        }

        .subscribe button {
            border: 0;
            padding: 0 22px;
            border-radius: 0 10px 10px 0;
            color: #fff;
            background: var(--gold);
        }

        footer {
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 35px;
            padding: 57px 0 25px;
            color: #777;
        }

        footer img {
            width: 180px;
            height: 105px;
            object-fit: contain;
        }

        footer h3 {
            margin: 13px 0 18px;
            color: #333;
            font-size: 16px;
        }

        footer p,
        footer a {
            display: block;
            margin: 8px 0;
            color: #777;
            line-height: 1.5;
            text-decoration: none;
        }

        .copyright {
            grid-column: 1/-1;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
        }

        @media(max-width:850px) {
            .details-layout {
                grid-template-columns: 1fr;
            }

            .recommendations {
                min-height: 0;
            }

            .recommended-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }

            .mini-course {
                margin: 0;
            }

            footer {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:560px) {
            .container {
                width: calc(100% - 30px);
            }

            .programme-hero {
                margin-bottom: 48px;
                padding: 32px 25px;
                display: block;
            }

            .programme-hero h1 {
                font-size: 37px;
            }

            .hero-action {
                margin-top: 26px;
                text-align: left;
            }

            .details-card {
                padding: 15px;
            }

            .cover {
                height: 210px;
            }

            .course-intro {
                grid-template-columns: 1fr;
            }

            .course-buy {
                text-align: left;
            }

            .recommended-list {
                grid-template-columns: 1fr;
            }

            .newsletter {
                padding: 45px 0;
            }

            footer>div:first-child {
                grid-column: 1/-1;
            }
        }
    </style>
</head>

<body>
    @include('components.site-header', ['active' => 'programmes'])
    <main>
        <section class="container programme-hero">
            <div>
                <h1>TCWTIR</h1>
                <div class="programme-meta"><span>♙ Albity Fesal</span><span>▣ Sun, 9 March 2025</span><span>▱ 60 Lessons</span><span>◷ 120 h :45 m</span></div>
            </div>
            <div class="hero-action">
                <div class="member-count">♙ 99 Member</div>
                <div class="hero-price">﷼ 20</div><a class="gold-button" href="{{ route('checkout') }}">Enroll now</a>
            </div>
        </section>
        <section class="container content">
            <h2>Program Details</h2>
            <div class="details-layout">
                <article class="details-card">
                    <div class="cover"><img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=85" alt="TCWTIR programme"></div>
                    <div class="card-meta"><span>♙ Albity Fesal</span><span>▣ Sun, 9 March 2025</span><span>▱ 60 Lessons</span><span>◷ 120 h :45 m</span><span>♙ 99 Member</span></div>
                    <div class="course-intro">
                        <div>
                            <h3>About TCWTIR</h3>
                            <p>In this inspiring episode, discover a simple yet powerful secret that has changed the lives of thousands.</p>
                            <p>We explore how small daily habits and a shift in mindset can lead to real, lasting transformation in your personal and learning journey.</p>
                            <p>A must-listen for anyone looking to grow, break out of the routine, and unlock their true potential.</p>
                        </div>
                        <div class="course-buy" id="enrol"><strong>﷼ 20</strong><a class="dark-button" href="{{ route('checkout') }}">Enroll now</a></div>
                    </div>
                    <div class="learn">
                        <h3>What You'll Learn</h3>
                        <ul>
                            <li>The key to building habits that truly make a difference</li>
                            <li>How to set a clear goal and stay committed to it</li>
                            <li>Psychological strategies to stay motivated even when it’s tough</li>
                            <li>The deep connection between continuous learning and real life change</li>
                        </ul>
                    </div>
                    <section class="cta">
                        <h3>Don’t Wait For Change. Create It.</h3>
                        <p>Enroll now and take the first step toward your transformation.</p><a class="gold-button" href="{{ route('checkout') }}">Enroll now</a>
                    </section>
                </article>
                <aside class="recommendations">
                    <h3>Recommended Courses</h3>
                    <div class="recommended-list">@for($i=0;$i<2;$i++)<article class="mini-course"><img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=85" alt="TCWTIR course">
                            <div class="mini-body">
                                <div class="mini-title"><span>TCWTIR</span><span>﷼ 4,000</span></div>
                                <div class="mini-info">▱ 12 lessons &nbsp; ◷ 14 h : 30 m &nbsp; ♙ 100 member</div>
                                <div class="mini-bottom"><span>Albity Fesal<br>Coach</span><a class="dark-button" href="{{ route('programmes.details') }}">View Course</a></div>
                            </div>
                            </article>@endfor</div>
                </aside>
            </div>
        </section>
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
            <h3>Pages</h3><a href="{{ route('programmes') }}">Programmes</a><a>Stories</a><a>News</a><a>Vip community</a>
        </div>
        <div>
            <h3>More</h3><a>Our Team</a><a>FAQ</a><a>Contact us</a><a>Shop</a>
        </div>
        <div class="copyright">© {{ date('Y') }} TCW. All rights reserved.</div>
    </footer>
</body>

</html>
