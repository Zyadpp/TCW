{{-- Public website programmes page --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programmes | TCW</title>
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

        .programme-hero {
            height: 263px;
            margin: 22px auto 30px;
            padding: 47px 20px;
            text-align: center;
            border-radius: 18px;
            background: var(--green);
            color: #fff
        }

        .programme-hero h1 {
            margin: 0 0 17px;
            font-size: 48px
        }

        .programme-hero p {
            max-width: 700px;
            margin: 0 auto 21px;
            font-size: 17px;
            line-height: 1.35;
            color: #d7e6de
        }

        .search {
            width: 310px;
            max-width: 100%;
            height: 38px;
            padding: 0 16px;
            border: 0;
            border-radius: 8px;
            outline: 0
        }

        .listing {
            padding: 58px 0 70px;
            background: var(--soft)
        }

        .listing.white {
            background: #fff
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px
        }

        .section-head h2 {
            margin: 0;
            font-size: 28px
        }

        .arrows {
            display: flex;
            gap: 13px
        }

        .arrow {
            width: 30px;
            height: 30px;
            border: 1px solid #c1c1c1;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 19px
        }

        .arrow.dark {
            border: 0;
            color: #fff;
            background: #000
        }

        .premium-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px
        }

        .support-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px
        }

        .course {
            overflow: hidden;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 11px 25px #14472d10
        }

        .course-image {
            position: relative
        }

        .course-image img {
            width: 100%;
            height: 245px;
            display: block;
            object-fit: cover
        }

        .heart {
            position: absolute;
            right: 14px;
            top: 12px;
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: #ffffff55
        }

        .course-body {
            padding: 12px 14px
        }

        .course-title {
            display: flex;
            justify-content: space-between;
            color: #333;
            font-weight: bold
        }

        .course-info {
            display: flex;
            gap: 17px;
            margin: 13px 0;
            color: #9a8c70;
            font-size: 11px
        }

        .course-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #666;
            font-size: 10px
        }

        .coach {
            display: flex;
            align-items: center;
            gap: 6px
        }

        .avatar {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #d9d9d9
        }

        .view {
            border: 0;
            border-radius: 17px;
            padding: 9px 15px;
            background: #000;
            color: #fff;
            font-size: 10px
        }

        .support-grid .course-image img {
            height: 125px
        }

        .support-grid .course-body {
            padding: 10px
        }

        .support-grid .course-info {
            gap: 7px;
            margin: 9px 0;
            font-size: 9px
        }

        .support-grid .course-footer {
            font-size: 8px
        }

        .support-grid .view {
            padding: 6px 9px;
            font-size: 8px
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
            .support-grid {
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

            .programme-hero {
                height: auto;
                padding: 35px 18px
            }

            .programme-hero h1 {
                font-size: 36px
            }

            .programme-hero p {
                font-size: 15px
            }

            .premium-grid,
            .support-grid {
                grid-template-columns: 1fr
            }

            .listing {
                padding: 42px 0
            }

            .course-image img {
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

<body>
    @include('components.site-header', ['active' => 'programmes'])
    @php($premium=['photo-1516321318423-f06f85e504b3','photo-1522202176988-66273c2fd55f','photo-1531482615713-2afd69097998','photo-1524178232363-1fb2b075b655'])
    @php($support=['photo-1522202176988-66273c2fd55f','photo-1531482615713-2afd69097998','photo-1516321318423-f06f85e504b3','photo-1524178232363-1fb2b075b655'])
    @php($courseCard=function($image){ return '<article class="course">
        <div class="course-image"><img src="https://images.unsplash.com/'.$image.'?auto=format&amp;fit=crop&amp;w=800&amp;q=85" alt="TCW programme"><span class="heart">♡</span></div>
        <div class="course-body">
            <div class="course-title"><span>TCWTIR</span><span>﷼ 4,000</span></div>
            <div class="course-info"><span>◷ 12 lessons</span><span>◷ 14 h : 30 m</span><span>♙ 100 member</span></div>
            <div class="course-footer"><span class="coach"><i class="avatar"></i>Albyf Feisal<br>Coach</span><a class="view" href="'.route('programmes.details').'">View More</a></div>
        </div>
    </article>'; })
    <main>
        <section class="container programme-hero">
            <h1>Programmes</h1>
            <p>At TCW, we offer interactive Programmes to help you gain new skills, advance your<br>career, and explore new fields with expert guidance.</p><input class="search" type="search" placeholder="⌕  Search your course here..." aria-label="Search programmes">
        </section>
        <section class="listing">
            <div class="container">
                <div class="section-head">
                    <h2>Premium Programmes</h2>
                    <div class="arrows"><span class="arrow">‹</span><span class="arrow dark">›</span></div>
                </div>
                <div class="premium-grid">@foreach($premium as $image){!! $courseCard($image) !!}@endforeach</div>
            </div>
        </section>
        <section class="listing white">
            <div class="container">
                <div class="section-head">
                    <h2>Support Programmes</h2>
                    <div class="arrows"><span class="arrow">‹</span><span class="arrow dark">›</span></div>
                </div>
                <div class="support-grid">@foreach($support as $image){!! $courseCard($image) !!}@endforeach</div>
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
