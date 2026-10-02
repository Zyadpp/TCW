{{-- Public website about page --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About us | TCW</title>
    <style>
        :root {
            --gold: #c59b4d;
            --green: #176047;
            --ink: #202837;
            --soft: #f2f8f5
        }

        * {
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth
        }

        body {
            margin: 0;
            font: 14px Arial, sans-serif;
            color: #3e4248
        }

        a {
            text-decoration: none;
            color: inherit
        }

        .container {
            width: min(1150px, calc(100% - 64px));
            margin: auto
        }

        .nav {
            height: 76px;
            display: flex;
            align-items: center;
            gap: 34px
        }

        .nav>img {
            width: 110px;
            height: 68px;
            object-fit: contain
        }

        .links {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-left: auto;
            color: var(--ink);
            font-size: 13px
        }

        .links .active {
            color: var(--gold);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 8px
        }

        .pill {
            padding: 11px 18px;
            border-radius: 22px;
            color: #fff;
            background: var(--gold)
        }

        .outline {
            color: var(--gold);
            background: #fff;
            border: 1px solid var(--gold)
        }

        .banner {
            height: 210px;
            margin: 26px auto 100px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: var(--green);
            color: #fff;
            font-size: 42px;
            font-weight: bold
        }

        .intro {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 75px;
            align-items: center;
            margin-bottom: 65px
        }

        .eyebrow {
            color: var(--gold);
            font-size: 12px;
            font-weight: bold
        }

        .intro h1 {
            margin: 20px 0;
            font-size: 28px;
            line-height: 1.15;
            color: #2c3035
        }

        .intro p {
            line-height: 1.45;
            color: #62676d
        }

        .intro strong {
            display: block;
            margin-top: 18px;
            color: var(--green)
        }

        .about-photo {
            position: relative
        }

        .about-photo:before {
            content: "";
            position: absolute;
            z-index: -1;
            width: 88px;
            height: 88px;
            left: -42px;
            bottom: -34px;
            border-radius: 50%;
            background: #e4cda0
        }

        .about-photo img {
            display: block;
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 16px;
            border: 2px solid #ddd
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin: 35px auto 76px;
            padding: 28px 48px;
            border-radius: 75px;
            background: linear-gradient(105deg, #0b1f55, #552d83);
            color: #fff
        }

        .stat {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #fff;
            color: var(--gold);
            font-size: 22px
        }

        .stat b {
            display: block;
            font-size: 25px
        }

        .stat small {
            color: #ddd
        }

        .programmes {
            padding: 55px 0 65px;
            background: var(--soft)
        }

        h2 {
            margin: 0 0 28px;
            color: #2b3035;
            font-size: 27px
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px
        }

        .course {
            overflow: hidden;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 8px 20px #17452b14
        }

        .course img {
            width: 100%;
            height: 115px;
            object-fit: cover
        }

        .course div {
            padding: 11px
        }

        .course b {
            font-size: 12px;
            color: #252525
        }

        .course p {
            margin: 9px 0 0;
            font-size: 10px;
            color: #737373
        }

        .team-section {
            padding: 64px 0 75px
        }

        .team {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px
        }

        .person {
            position: relative;
            padding-bottom: 35px
        }

        .person img {
            display: block;
            width: 100%;
            height: 250px;
            object-fit: cover
        }

        .person div {
            position: absolute;
            bottom: 0;
            left: 10px;
            right: 10px;
            padding: 14px 8px;
            background: #fff;
            box-shadow: 0 1px 5px #0002;
            text-align: center
        }

        .person b {
            display: block;
            color: #333
        }

        .person small {
            display: block;
            margin-top: 6px;
            color: #9a9a9a
        }

        .newsletter {
            padding: 62px 0;
            background: var(--soft)
        }

        .newsletter h2 {
            color: var(--green)
        }

        .newsletter p {
            max-width: 500px;
            color: #65716d;
            font-size: 15px
        }

        .subscribe {
            display: flex;
            width: 370px;
            max-width: 100%;
            height: 45px;
            margin-top: 25px
        }

        .subscribe input {
            flex: 1;
            min-width: 0;
            border: 1px solid #ddd;
            border-radius: 9px 0 0 9px;
            padding: 0 16px
        }

        .subscribe button {
            border: 0;
            border-radius: 0 9px 9px 0;
            padding: 0 22px;
            background: var(--gold);
            color: #fff
        }

        .footer {
            padding: 58px 0 25px
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 32px
        }

        .footer img {
            width: 180px;
            height: 100px;
            object-fit: contain
        }

        .footer p,
        .footer a {
            display: block;
            margin: 8px 0;
            color: #777;
            line-height: 1.5
        }

        .footer h4 {
            margin: 16px 0;
            color: #333
        }

        .copyright {
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #777;
            font-size: 12px
        }

        @media(max-width:800px) {
            .links {
                gap: 12px
            }

            .links a:nth-child(4),
            .links a:nth-child(5),
            .links a:nth-child(6),
            .links a:nth-child(7) {
                display: none
            }

            .intro {
                gap: 30px
            }

            .cards,
            .team {
                grid-template-columns: repeat(2, 1fr)
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
                border-radius: 28px
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:520px) {
            .container {
                width: calc(100% - 30px)
            }

            .nav {
                gap: 8px
            }

            .nav>img {
                width: 70px
            }

            .links {
                font-size: 11px
            }

            .links a:nth-child(2),
            .outline {
                display: none
            }

            .pill {
                padding: 9px 12px
            }

            .banner {
                height: 135px;
                margin: 15px auto 50px;
                font-size: 34px
            }

            .intro {
                grid-template-columns: 1fr
            }

            .intro h1 {
                font-size: 25px
            }

            .about-photo {
                order: -1
            }

            .about-photo img {
                height: 220px
            }

            .stats {
                padding: 22px
            }

            .stat b {
                font-size: 20px
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr
            }

            .footer-grid>div:first-child {
                grid-column: 1/-1
            }
        }
    </style>
</head>

<body>
    @include('components.site-header', ['active' => 'about'])
    <main>
        <section class="container banner">About us</section>
        <section class="container intro">
            <div><span class="eyebrow">About us</span>
                <h1>TCW Platform For An Innovative<br>Learning Experience</h1>
                <p>TCW is an interactive learning platform that provides tools for organizing study content, tracking progress, and enabling seamless interaction between students and teachers. Our goal is to empower smart and innovative learning for everyone.</p><strong>Our Vision:</strong>
                <p>Empowering learners to access knowledge in a seamless and intelligent way.</p><strong>Our Mission:</strong>
                <p>Providing innovative educational solutions that meet the needs of the digital age.</p>
            </div>
            <div class="about-photo"><img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=900&q=85" alt="TCW team at an event"></div>
        </section>
        <section class="container stats">
            <div class="stat"><span class="stat-icon">♙</span><span><b>1K+</b><small>Successfully Trained</small></span></div>
            <div class="stat"><span class="stat-icon">✦</span><span><b>10+</b><small>Completed Rounds</small></span></div>
            <div class="stat"><span class="stat-icon">☼</span><span><b>4.5+</b><small>Satisfaction Rate</small></span></div>
            <div class="stat"><span class="stat-icon">▦</span><span><b>102K+</b><small>Students Community</small></span></div>
        </section>
        <section class="programmes">
            <div class="container">
                <h2>Our Programmes</h2>
                <div class="cards">@foreach(['photo-1522202176988-66273c2fd55f','photo-1531482615713-2afd69097998','photo-1516321318423-f06f85e504b3','photo-1543269865-cbf427effbad'] as $image)<article class="course"><img src="https://images.unsplash.com/{{ $image }}?auto=format&fit=crop&w=500&q=80" alt="Programme">
                        <div><b>TCWTIR</b>
                            <p>12 lessons &nbsp; • &nbsp; 14h : 30m &nbsp; • &nbsp; 100 members</p>
                        </div>
                    </article>@endforeach</div>
            </div>
        </section>
        <section class="container team-section">
            <h2>Meet Our Team</h2>
            <div class="team">@foreach([['Khaled Badr','Motion Graphic Instructor','photo-1500648767791-00dcc994a43e'],['Mohamed Osama','React Instructor','photo-1507003211169-0a1dd7228f2d'],['Mohamed Salam','UI UX Instructor','photo-1560250097-0b93528c311a'],['Dina Al-Sulaimani','UI UX Mentor','photo-1494790108377-be9c29b29330']] as $person)<article class="person"><img src="https://images.unsplash.com/{{ $person[2] }}?auto=format&fit=crop&w=500&q=80" alt="{{ $person[0] }}">
                    <div><b>{{ $person[0] }}</b><small>{{ $person[1] }}</small></div>
                </article>@endforeach</div>
        </section>
    </main>
    <section class="newsletter">
        <div class="container">
            <h2>Subscribe Our Newsletter</h2>
            <p>Join now to receive personalized recommendations from the full Coursera catalog.</p>
            <form class="subscribe"><input type="email" placeholder="Enter your mail" aria-label="Email"><button type="button">Subscribe</button></form>
        </div>
    </section>
    <footer class="container footer">
        <div class="footer-grid">
            <div><img src="{{ asset('images/logo.png') }}" alt="The Certain Way">
                <p>Join now to get personalized course recommendations from TCW’s exclusive learning catalog!</p>
            </div>
            <div>
                <h4>Contact us</h4><a>+980 385 6532</a><a>+758 6987 265</a><a>info@tcw.com</a>
            </div>
            <div>
                <h4>Company</h4><a href="{{ route('landing') }}">Home</a><a href="{{ route('about') }}">About us</a><a>Projects</a><a>Services</a>
            </div>
            <div>
                <h4>Pages</h4><a>Programmes</a><a>Stories</a><a>News</a><a>Vip community</a>
            </div>
            <div>
                <h4>More</h4><a>Our Team</a><a>FAQ</a><a>Contact us</a><a>Shop</a>
            </div>
        </div>
        <p class="copyright">© {{ date('Y') }} TCW. All rights reserved.</p>
    </footer>
</body>

</html>
