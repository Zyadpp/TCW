{{-- Public website services page --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services | TCW</title>
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
            color: #252a31
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
            color: #fff;
            background: var(--green);
            font-size: 49px;
            font-weight: bold
        }

        .services {
            padding-bottom: 76px
        }

        .services h1 {
            margin: 0 0 34px;
            font-size: 29px
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px
        }

        .service {
            min-height: 275px;
            padding: 39px 36px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 14px 30px #15242a0c
        }

        .service-icon {
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            margin-bottom: 25px;
            color: var(--gold);
            font-size: 39px;
            line-height: 1
        }

        .service h2 {
            margin: 0 0 14px;
            font-size: 22px;
            line-height: 1.25
        }

        .service p {
            margin: 0;
            color: #777;
            line-height: 1.45;
            font-size: 15px
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

        @media(max-width:850px) {
            .service-grid {
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

            .hero {
                height: 135px;
                margin-bottom: 48px;
                font-size: 36px
            }

            .service-grid {
                grid-template-columns: 1fr
            }

            .service {
                min-height: 230px;
                padding: 30px
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
    @include('components.site-header', ['active' => 'services'])
    @php($services=[['◔','Smart Student Dashboard','A personalized dashboard to help students track their course progress, upcoming deadlines, and overall performance in one central place.'],['▤','Premium & Support Programmes','Access exclusive Premium Programmes for advanced skills and career growth, and join Support Programmes for personalized guidance and academic help.'],['▣','Tasks & Project System','Easily manage and submit tasks or long-term projects with clear deadlines, instructions, and real-time submission status.'],['▦','Learning Events & Activities','Stay engaged with live events, challenges, and educational activities hosted regularly for the community.'],['♙','AI Chatbot Assistant','Get instant, 24/7 answers to your questions and guidance navigating the platform.'],['◎','Master Mind & VVIP Community','Get exclusive access to Master Mind, a premium learning circle with a high-achieving VVIP community for advanced discussion and collaboration.'],['◉','Mentorship & Guidance','Connect with dedicated mentors for personalized academic and career support throughout your learning journey.'],['♕','Points & Rewards System','Earn points for your progress, unlock badges, and get rewards that recognize your learning efforts.'],['▧','TCW Media','Watch short, engaging educational reels to reinforce concepts, stay motivated, and discover tips in a fun, visual way.']])
    <main class="container">
        <section class="hero">Services</section>
        <section class="services">
            <h1>TCW Services</h1>
            <div class="service-grid">@foreach($services as [$icon,$title,$description])<article class="service"><span class="service-icon">{{ $icon }}</span>
                    <h2>{{ $title }}</h2>
                    <p>{{ $description }}</p>
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