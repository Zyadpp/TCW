{{-- Public website projects page --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projects | TCW</title>
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
            font: 14px Arial, sans-serif;
            color: #282d34
        }

        .container {
            width: min(1150px, calc(100% - 64px));
            margin: auto
        }

        .hero-title {
            height: 210px;
            display: grid;
            place-items: center;
            margin: 22px auto 76px;
            border-radius: 18px;
            background: var(--green);
            color: #fff;
            font-size: 48px;
            font-weight: bold
        }

        .gallery {
            margin-bottom: 70px
        }

        .gallery-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px
        }

        .gallery h1 {
            margin: 0;
            font-size: 29px
        }

        .arrows {
            display: flex;
            gap: 13px
        }

        .arrow {
            width: 32px;
            height: 32px;
            border: 1px solid #bbb;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 20px
        }

        .arrow.dark {
            border: 0;
            color: #fff;
            background: #000
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px
        }

        .project-card {
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 15px;
            background: #faf7ec
        }

        .project-card img {
            width: 100%;
            height: 360px;
            display: block;
            object-fit: cover
        }

        .graphic .project-card {
            background: #090916
        }

        .graphic .project-card img {
            height: 390px
        }

        .newsletter {
            margin-top: 68px;
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
            line-height: 1.5;
            color: #777;
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

        @media(max-width:800px) {
            .grid {
                grid-template-columns: repeat(2, 1fr)
            }

            footer {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:520px) {
            .container {
                width: calc(100% - 30px)
            }

            .hero-title {
                height: 135px;
                margin-bottom: 45px;
                font-size: 36px
            }

            .gallery {
                margin-bottom: 45px
            }

            .project-card img,
            .graphic .project-card img {
                height: 240px
            }

            .grid {
                gap: 12px
            }

            .newsletter {
                margin-top: 35px;
                padding: 45px 0
            }

            footer>div:first-child {
                grid-column: 1/-1
            }
        }
    </style>
</head>

<body>
    @include('components.site-header', ['active' => 'projects'])
    <main class="container">
        <section class="hero-title">Projects</section>
        <section class="gallery">
            <div class="gallery-head">
                <h1>UI Projects</h1>
                <div class="arrows"><span class="arrow">‹</span><span class="arrow dark">›</span></div>
            </div>
            <div class="grid">@foreach(['photo-1618220179428-22790b461013','photo-1616486338812-3dadae4b4ace','photo-1600210492486-724fe5c67fb0','photo-1617104678098-de229db51175'] as $image)<article class="project-card"><img src="https://images.unsplash.com/{{ $image }}?auto=format&fit=crop&w=600&q=85" alt="UI project"></article>@endforeach</div>
        </section>
        <section class="gallery graphic">
            <div class="gallery-head">
                <h1>Graphic Projects</h1>
                <div class="arrows"><span class="arrow">‹</span><span class="arrow dark">›</span></div>
            </div>
            <div class="grid">@foreach(['photo-1635070041078-e363dbe005cb','photo-1634017839464-5c339ebe3cb4','photo-1618172193763-c511deb635ca','photo-1634017839464-5c339ebe3cb4'] as $image)<article class="project-card"><img src="https://images.unsplash.com/{{ $image }}?auto=format&fit=crop&w=600&q=85" alt="Graphic project"></article>@endforeach</div>
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
            <h3>Company</h3><a href="{{ route('landing') }}">Home</a><a href="{{ route('about') }}">About us</a><a href="{{ route('projects') }}">Projects</a><a>Services</a>
        </div>
        <div>
            <h3>Pages</h3><a>Programmes</a><a>Stories</a><a>News</a><a>Vip community</a>
        </div>
        <div>
            <h3>More</h3><a>Our Team</a><a>FAQ</a><a>Contact us</a><a>Shop</a>
        </div>
        <div class="copyright">© {{ date('Y') }} TCW. All rights reserved.</div>
    </footer>
</body>

</html>