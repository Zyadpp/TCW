<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>FAQ | TCW</title>
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
            height: 218px;
            display: grid;
            place-items: center;
            margin: 22px auto 102px;
            border-radius: 18px;
            background: var(--green);
            color: #fff;
            font-size: 48px;
            font-weight: bold
        }

        .faq {
            padding-bottom: 76px
        }

        .faq h1 {
            margin: 0 0 36px;
            font-size: 29px
        }

        .columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px
        }

        .item {
            margin-bottom: 6px;
            border: 1px solid #e1e2e3
        }

        .question {
            width: 100%;
            padding: 20px;
            border: 0;
            background: #fff;
            color: var(--green);
            text-align: left;
            font: 18px Arial;
            cursor: pointer
        }

        .question::after {
            content: '⌄';
            float: right;
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            margin-top: -6px;
            background: #000;
            color: #fff
        }

        .answer {
            display: none;
            padding: 0 20px 20px;
            color: #58606a;
            font-size: 15px;
            line-height: 1.5
        }

        .item.open .answer {
            display: block
        }

        .item.open .question::after {
            content: '⌃'
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
            .columns {
                grid-template-columns: 1fr
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
                height: 150px;
                margin-bottom: 50px;
                font-size: 36px
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
    @php($questions=['What Is TCW?','Will I Get A Certificate After Completing A Course?','Can I Learn At My Own Pace?','How Do I Join A Learning Group On TCW?','Can I Access TCW On Mobile?','How Can I Sign Up For The Platform?','How Can I Pay For Courses?','Is There Technical Support If I Face An Issue?','Does TCW Provide Certificates?','How Can I Reset My Password?'])
    <main class="container">
        <section class="hero">FAQ Page</section>
        <section class="faq">
            <h1>FAQ</h1>
            <div class="columns">@foreach(array_chunk($questions,5) as $column)<div>@foreach($column as $index => $question)<article class="item {{ $question === 'What Is TCW?' ? 'open' : '' }}"><button class="question" type="button">{{ $question }}</button>
                        <div class="answer">TCW is a learning platform that provides innovative educational content, powerful tools, and a supportive community to help users grow and succeed.</div>
                    </article>@endforeach</div>@endforeach</div>
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
    <script>
        document.querySelectorAll('.question').forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.classList.toggle('open')
            })
        })
    </script>
</body>

</html>