<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact us | TCW</title>
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
            margin: 22px auto 102px;
            border-radius: 18px;
            background: var(--green);
            color: #fff;
            font-size: 49px;
            font-weight: bold
        }

        .contact {
            padding-bottom: 76px
        }

        .contact h1 {
            margin: 0 0 42px;
            font-size: 29px
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 385px;
            gap: 85px
        }

        .fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 45px 58px
        }

        .field {
            border: 0;
            border-bottom: 2px solid #eee;
            padding: 0 0 16px;
            color: #37405a;
            font: 18px Arial;
            outline: none
        }

        .field::placeholder {
            color: #37405a;
            opacity: 1
        }

        .field.full {
            grid-column: span 2
        }

        .required {
            color: var(--green);
            font-size: 13px
        }

        .send {
            grid-column: span 2;
            height: 53px;
            border: 0;
            border-radius: 28px;
            background: #000;
            color: #fff;
            font-weight: bold;
            cursor: pointer
        }

        .info {
            padding: 38px 30px;
            border: 1px solid #ddd;
            border-radius: 16px
        }

        .info div {
            padding: 0 0 23px;
            margin-bottom: 23px;
            border-bottom: 1px solid #eee;
            line-height: 1.55
        }

        .info div:last-child {
            border: 0;
            margin: 0
        }

        .info small {
            display: block;
            margin-bottom: 15px;
            color: var(--gold)
        }

        .social {
            display: flex;
            gap: 17px
        }

        .social span {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
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
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 40px
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
                margin-bottom: 50px;
                font-size: 36px
            }

            .fields {
                grid-template-columns: 1fr;
                gap: 30px
            }

            .field.full,
            .send {
                grid-column: auto
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
    <main class="container">
        <section class="hero">Contact us</section>
        <section class="contact">
            <h1>Contact Us</h1>
            <div class="contact-grid">
                <form class="fields"><input class="field full" required placeholder="Name     Required"><input class="field" required type="email" placeholder="Email Address     Required"><input class="field" placeholder="Phone     Optional"><textarea class="field full" rows="2" placeholder="Message"></textarea><button class="send" type="button">Send Message</button></form>
                <aside class="info">
                    <div><small>Mobile Phone</small>☎ &nbsp; +980 385 6532<br>&nbsp;&nbsp;&nbsp;&nbsp; +758 6987 265</div>
                    <div><small>Email Address</small>✉ &nbsp; Info@Tcw.Com</div>
                    <div><small>Location</small>● &nbsp; DAMMAM - SAUDI ARABIA</div>
                    <div class="social"><span>♪</span><span>◉</span><span>◎</span><span>f</span></div>
                </aside>
            </div>
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