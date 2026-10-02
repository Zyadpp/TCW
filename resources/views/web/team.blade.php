<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Our Team | TCW</title>
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
            margin: 22px auto 84px;
            border-radius: 18px;
            background: var(--green);
            color: #fff;
            font-size: 49px;
            font-weight: bold
        }

        .team h1 {
            margin: 0 0 30px;
            font-size: 28px
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px 20px;
            padding-bottom: 83px
        }

        .person {
            position: relative;
            height: 334px;
            background: #eee
        }

        .person img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .person div {
            position: absolute;
            right: 12px;
            bottom: -30px;
            left: 12px;
            padding: 17px 10px;
            background: #fff;
            text-align: center;
            box-shadow: 0 2px 6px #0001
        }

        .person b,
        .person small {
            display: block
        }

        .person b {
            font-size: 16px
        }

        .person small {
            margin-top: 8px;
            color: #aaa
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
                margin-bottom: 45px;
                font-size: 36px
            }

            .grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 45px 12px
            }

            .person {
                height: 245px
            }

            .person b {
                font-size: 13px
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

<body>@include('components.site-header')
    @php($people=[['Khaled Badr','Motion Graphic Instructor'],['Mohamed Osama','React Instructor'],['Mohamed Salam','UI UX Instructor'],['Dina Al-Sulaimani','UI UX Mentor'],['Ahmed Sabry','Motion Graphic Instructor'],['Ramy Ali','React Instructor'],['Aya Salama','React Instructor'],['Mohand Ahmed','React Instructor'],['Nour Ahmed','React Instructor'],['Noor Ahmaed','Motion Graphic Instructor'],['Nada Ali','React Instructor'],['Amany Ali','React Instructor']])
    <main class="container">
        <section class="hero">Our Team</section>
        <section class="team">
            <h1>Meet Our Team</h1>
            <div class="grid">@foreach($people as $index => [$name,$role])<article class="person"><img src="{{ asset('images/team-' . ($index + 1) . '.jpg') }}" alt="{{ $name }}">
                    <div><b>{{ $name }}</b><small>{{ $role }}</small></div>
                </article>@endforeach</div>
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
            <h3>More</h3><a href="{{ route('team') }}">Our Team</a><a href="{{ route('faq') }}">FAQ</a><a href="{{ route('contact') }}">Contact us</a><a>Shop</a>
        </div>
        <div class="copyright">© {{ date('Y') }} TCW. All rights reserved.</div>
    </footer>
</body>

</html>