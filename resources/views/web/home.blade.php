{{-- Public website home page --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | TCW</title>
    <style>
        :root {
            --gold: #c59b4d;
            --ink: #17233a;
            --green: #286052;
            --soft: #f2f8f5;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #fff;
            color: #253044;
            font: 14px Arial, sans-serif;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(1150px, calc(100% - 64px));
            margin: auto;
        }

        .nav {
            height: 65px;
            display: flex;
            align-items: center;
            gap: 34px;
        }

        .nav img {
            width: 100px;
            height: 58px;
            object-fit: contain;
        }

        .links {
            display: flex;
            gap: 28px;
            align-items: center;
            margin-left: auto;
            font-size: 13px;
        }

        .links a:first-child {
            color: var(--gold);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 8px;
        }

        .pill {
            padding: 11px 18px;
            border-radius: 20px;
            background: var(--gold);
            color: #fff;
        }

        .outline {
            border: 1px solid var(--gold);
            background: #fff;
            color: var(--gold);
        }

        .hero {
            min-height: 5px;
            border-radius: 18px;
            padding: 50px 100px;
            color: #fff;
            background:
                linear-gradient(90deg,
                    rgba(12, 16, 21, 0.76),
                    rgba(12, 16, 21, 0.2)),
                url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?auto=format&fit=crop&w=1600&q=85') center / cover;
        }

        .hero h1 {
            max-width: 500px;
            margin: 0 0 18px;
            font-size: 34px;
            line-height: 1.15;
        }

        .hero p {
            max-width: 520px;
            font-size: 17px;
            line-height: 1.5;
        }

        .dark-btn,
        .card-btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 24px;
            background: #000;
            color: #fff;
            font-size: 12px;
            margin-top: 12px;
        }

        .partners {
            padding: 38px 0 52px;
        }

        .partners img {
            display: block;
            width: 100%;
            height: auto;
        }

        .section {
            padding: 55px 0;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 12px;
        }

        .about {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px;
            align-items: center;
        }

        .about h2,
        .section h2 {
            font-size: 28px;
            line-height: 1.12;
            margin: 15px 0;
        }

        .about p {
            color: #627084;
            line-height: 1.5;
        }

        .about strong {
            display: block;
            color: var(--green);
            margin-top: 15px;
        }

        .about img {
            width: 80%;
            height: 320px;
            object-fit: cover;
            border-radius: 18px;
            justify-self: end;
            transform: translateX(24px);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            align-items: center;
            gap: 20px;
            margin: 55px auto;
            padding: 35px 48px;
            border-radius: 85px;
            background: linear-gradient(105deg, #102a63, #593080);
            color: #fff;
        }

        .stat {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }

        .stat i {
            display: grid;
            place-items: center;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #fff;
            color: var(--gold);
            font-style: normal;
            font-size: 23px;
        }

        .stat b {
            font-size: 27px;
            display: block;
        }

        .stat span {
            font-size: 11px;
        }

        .soft {
            background: var(--soft);
        }

        .courses,
        .news,
        .team {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .course,
        .news-card,
        .person {
            overflow: hidden;
            border: 1px solid #e7ebeb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(18, 40, 54, 0.06);
        }

        .course img,
        .news-card img {
            width: 100%;
            height: 155px;
            object-fit: cover;
        }

        .course .body,
        .news-card .body {
            padding: 14px;
        }

        .course h3 {
            font-size: 14px;
            margin: 0 0 10px;
        }

        .meta {
            font-size: 11px;
            color: #8a96a5;
        }

        .person img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        .person div {
            padding: 13px;
            text-align: center;
        }

        .person b {
            display: block;
        }

        .person small {
            color: #8993a0;
        }

        .news {
            grid-template-columns: repeat(3, 1fr);
        }

        .news-card img {
            height: 220px;
        }

        .news-card h3 {
            font-size: 17px;
            line-height: 1.25;
        }

        .faq {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .faq details {
            padding: 18px;
            border: 1px solid #dce7e4;
            color: var(--green);
            background: #fff;
        }

        .faq summary {
            cursor: pointer;
            font-weight: 600;
        }

        .faq p {
            color: #687585;
            line-height: 1.5;
        }

        .newsletter {
            background: #edf6f3;
            padding: 55px 0;
        }

        .subscribe {
            display: flex;
            width: min(430px, 100%);
            height: 48px;
            border: 1px solid #dde5e2;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .subscribe input {
            flex: 1;
            border: 0;
            padding: 0 15px;
            outline: 0;
        }

        .subscribe button {
            border: 0;
            background: var(--gold);
            color: #fff;
            padding: 0 23px;
        }

        .footer {
            padding: 70px 0 25px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(4, 1fr);
            gap: 30px;
        }

        .footer img {
            width: 160px;
        }

        .footer h4 {
            margin: 15px 0;
        }

        .footer a {
            display: block;
            color: #687585;
            margin: 12px 0;
        }

        .copy {
            padding-top: 25px;
            border-top: 1px solid #e4e4e4;
            text-align: center;
            color: #8a96a5;
            font-size: 12px;
        }

        .welcome {
            margin-left: auto;
            color: var(--green);
            font-weight: 600;
        }


        /* =========================
   Responsive - Tablet
   ========================= */

        @media (max-width: 850px) {

            .container {
                width: min(100% - 32px, 700px);
            }

            .links {
                display: none;
            }

            .hero {
                min-height: 330px;
                padding: 50px 28px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .partners,
            .courses,
            .team {
                grid-template-columns: repeat(2, 1fr);
            }

            .about,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
                border-radius: 30px;
                padding: 28px;
            }

            .news {
                grid-template-columns: 1fr;
            }

            .faq {
                grid-template-columns: 1fr;
            }
        }


        /* =========================
   Responsive - Mobile
   ========================= */

        @media (max-width: 480px) {

            .partners {
                grid-template-columns: 1fr 1fr;
                padding: 40px 0;
            }

            .courses,
            .team,
            .stats {
                grid-template-columns: 1fr;
            }

            .hero {
                border-radius: 12px;
            }

            .section {
                padding: 38px 0;
            }
        }
    </style>
</head>

<body>
    @include('components.site-header', ['active' => 'home'])
    <main id="home">
        <section class="container hero">
            <h1>Limitless learning at your fingertips</h1>
            <p>Online learning and teaching marketplace with 5K+ courses &amp; 10M students. Taught by experts to help you acquire new skills.</p>
            <a class="dark-btn" href="#programmes">Get started</a>
        </section>

        <section class="container partners" aria-label="Our partners">
            <img src="{{ asset('images/partners-logos.png') }}" alt="Al Hokair Group, Sanabil Alkhair, Arbah Capital, Academy of Learning, and Mobily">
        </section>

        <section id="about" class="container section about">
            <div>
                <span class="eyebrow">About us</span>
                <h2>TCW Platform For An Innovative Learning Experience</h2>
                <p>TCW is an interactive learning platform that provides tools for organizing study content, tracking progress, and enabling seamless interaction between students and teachers.</p>
                <strong>Our Vision:</strong>
                <p>Empowering learners to access knowledge in a seamless and intelligent way.</p>
                <strong>Our Mission:</strong>
                <p>Providing innovative educational solutions that meet the needs of the digital age.</p>
            </div>

            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85" alt="Teacher helping students learn">
        </section>
        <section class="container stats">
            <div class="stat"><i>♙</i>
                <div><b>1K+</b><span>Successfully Trained</span></div>
            </div>
            <div class="stat"><i>✺</i>
                <div><b>10+</b><span>Completed Rounds</span></div>
            </div>
            <div class="stat"><i>◌</i>
                <div><b>4.5+</b><span>Satisfaction Rate</span></div>
            </div>
            <div class="stat"><i>▤</i>
                <div><b>102K+</b><span>Students Community</span></div>
            </div>
        </section>
        @php
        $courses = [
        ['title' => 'UI/UX Basics', 'photo' => 'photo-1556761175-b413da4baf72'],
        ['title' => 'JavaScript Essentials', 'photo' => 'photo-1516321318423-f06f85e504b3'],
        ['title' => 'Python For Beginners', 'photo' => 'photo-1584697964358-3e14ca57658b'],
        ['title' => 'Data Structures & Algorithms', 'photo' => 'photo-1454165804606-c3d57bc86b40'],
        ];
        @endphp

        <section id="programmes" class="soft">
            <div class="container section">
                <h2>Success Stories</h2>
                <div class="courses">
                    @foreach ($courses as $course)
                    <article class="course">
                        <img src="https://images.unsplash.com/{{ $course['photo'] }}?auto=format&fit=crop&w=500&q=80" alt="{{ $course['title'] }}">
                        <div class="body">
                            <h3>{{ $course['title'] }}</h3>
                            <p class="meta">12 lessons &nbsp; • &nbsp; 14h 30m &nbsp; • &nbsp; 5 available</p>
                            <a class="card-btn" href="#">View More</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @php
        $newsItems = [
        ['title' => 'Launch of Our First Training Courses!', 'photo' => 'photo-1523240795612-9a054b0db644'],
        ['title' => 'Personalized Courses For Your Level!', 'photo' => 'photo-1516321318423-f06f85e504b3'],
        ['title' => 'Learn at Your Own Pace!', 'photo' => 'photo-1524178232363-1fb2b075b655'],
        ];
        @endphp

        <section id="news" class="container section">
            <h2>News</h2>
            <div class="news">
                @foreach ($newsItems as $newsItem)
                <article class="news-card">
                    <img src="https://images.unsplash.com/{{ $newsItem['photo'] }}?auto=format&fit=crop&w=750&q=80" alt="{{ $newsItem['title'] }}">
                    <div class="body">
                        <p class="meta">Learning &nbsp; October 6, 2024</p>
                        <h3>{{ $newsItem['title'] }}</h3>
                        <p class="meta">We are proud to introduce a new way to learn, at your own pace.</p>
                        <a class="card-btn" href="#">Read more →</a>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @php
        $team = [
        ['name' => 'Khaled Badr', 'role' => 'Motion Graphic Instructor', 'photo' => 'photo-1500648767791-00dcc994a43e'],
        ['name' => 'Mohamed Osama', 'role' => 'React Instructor', 'photo' => 'photo-1507003211169-0a1dd7228f2d'],
        ['name' => 'Mohamed Salam', 'role' => 'UI UX Instructor', 'photo' => 'photo-1560250097-0b93528c311a'],
        ['name' => 'Dina Al-Sulaimani', 'role' => 'UI UX Mentor', 'photo' => 'photo-1494790108377-be9c29b29330'],
        ];
        @endphp

        <section id="stories" class="container section">
            <h2>Meet Our Team</h2>
            <div class="team">
                @foreach ($team as $person)
                <article class="person">
                    <img src="https://images.unsplash.com/{{ $person['photo'] }}?auto=format&fit=crop&w=500&q=80" alt="{{ $person['name'] }}">
                    <div>
                        <b>{{ $person['name'] }}</b>
                        <small>{{ $person['role'] }}</small>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @php
        $faqs = [
        'What Is TCW?' => 'TCW is a digital learning platform built to help students learn with confidence.',
        'How Can I Sign Up For The Platform?' => 'Create your account, verify your email, and start exploring programmes.',
        'Will I Get A Certificate After Completing A Course?' => 'Certificates are available for eligible courses.',
        'How Can I Pay For Courses?' => 'Choose a programme and use the payment option provided.',
        'Can I Learn At My Own Pace?' => 'Yes. Learn from your dashboard at the pace that suits you.',
        'Is There Technical Support If I Face An Issue?' => 'Our support team is available to help you.',
        ];
        @endphp

        <section class="container section">
            <h2>FAQ</h2>
            <div class="faq">
                @foreach ($faqs as $question => $answer)
                <details>
                    <summary>{{ $question }}</summary>
                    <p>{{ $answer }}</p>
                </details>
                @endforeach
            </div>
        </section>
    </main>
    <section class="newsletter">
        <div class="container">
            <h2>Subscribe Our Newsletter</h2>
            <p>Join now to receive personalized recommendations from the full course catalog.</p>

            <form class="subscribe">
                <input type="email" placeholder="Enter your mail" aria-label="Email">
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </section>
    <footer class="container footer">
        <div class="footer-grid">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="The Certain Way">
                <p>Join now to get personalized course recommendations from TCW's exclusive learning catalog!</p>
            </div>

            <div>
                <h4>Contact us</h4>
                <a href="#">+980 85 857 0325</a>
                <a href="#">+758 6987 265</a>
                <a href="#">info@tcw.com</a>
            </div>

            <div>
                <h4>Company</h4>
                <a href="#home">Home</a>
                <a href="#about">About us</a>
                <a href="#projects">Projects</a>
                <a href="#services">Services</a>
            </div>

            <div>
                <h4>Pages</h4>
                <a href="#programmes">Programmes</a>
                <a href="#stories">Stories</a>
                <a href="#news">News</a>
                <a href="#">VIP community</a>
            </div>

            <div>
                <h4>More</h4>
                <a href="#">Our Team</a>
                <a href="#">FAQ</a>
                <a href="#">Contact us</a>
                <a href="#">Shop</a>
            </div>
        </div>

        <p class="copy">&copy; 2025 TCW. All rights reserved.</p>
    </footer>
</body>

</html>