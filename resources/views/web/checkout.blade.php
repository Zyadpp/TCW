<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Check out | TCW</title>
    <style>
        :root {
            --green: #176047;
            --gold: #c59b4d;
            --soft: #f1f8f5;
            --ink: #252a31
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            color: var(--ink);
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

        .checkout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 390px;
            gap: 76px;
            min-height: 610px;
            padding-bottom: 74px
        }

        h1 {
            margin: 0 0 24px;
            font-size: 29px
        }

        .methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 18px
        }

        .method {
            height: 78px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            color: #69718a;
            cursor: pointer
        }

        .method input {
            position: absolute;
            opacity: 0
        }

        .method:has(input:checked) {
            border-color: var(--gold);
            box-shadow: inset 0 0 0 1px var(--gold)
        }

        .method strong {
            display: block;
            margin-bottom: 14px;
            color: #193767;
            font-size: 17px
        }

        .field {
            display: block;
            margin-top: 13px;
            font-size: 13px;
            font-weight: bold
        }

        .field input {
            width: 100%;
            height: 42px;
            margin-top: 6px;
            padding: 0 13px;
            border: 1px solid #e1e3e7;
            border-radius: 8px;
            outline-color: var(--gold);
            font: inherit
        }

        .pair {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px
        }

        .summary {
            min-height: 570px;
            padding: 31px 24px;
            border-radius: 15px;
            background: #fafafa
        }

        .summary h2 {
            margin: 0 0 29px;
            color: #414963;
            font-size: 17px
        }

        .course {
            display: grid;
            grid-template-columns: 91px 1fr;
            gap: 14px;
            padding-bottom: 23px;
            border-bottom: 1px solid #ddd
        }

        .course img {
            width: 91px;
            height: 72px;
            border-radius: 9px;
            object-fit: cover
        }

        .course strong {
            display: block;
            margin-bottom: 8px
        }

        .course p {
            margin: 0;
            color: #8b806d;
            font-size: 11px;
            line-height: 1.7
        }

        .totals {
            padding-top: 16px;
            color: #596077
        }

        .line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 23px
        }

        .total {
            margin-top: 20px;
            padding-top: 24px;
            border-top: 1px solid #ddd;
            font-size: 17px;
            font-weight: bold;
            color: #3f465d
        }

        .pay {
            width: 100%;
            height: 45px;
            margin-top: 38px;
            border: 0;
            border-radius: 24px;
            background: #000;
            color: #fff;
            cursor: pointer;
            font: 600 15px Arial
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

        .modal {
            position: fixed;
            z-index: 10;
            inset: 0;
            display: none;
            place-items: center;
            padding: 20px;
            background: #0004
        }

        .modal.open {
            display: grid
        }

        .dialog {
            width: min(580px, 100%);
            padding: 44px 70px;
            border-radius: 18px;
            background: #fff;
            text-align: center
        }

        .tick {
            width: 94px;
            height: 94px;
            display: grid;
            place-items: center;
            margin: 0 auto 26px;
            border-radius: 50%;
            background: #59ba36;
            color: #fff;
            font-size: 62px;
            font-weight: bold
        }

        .dialog h2 {
            margin: 0 0 17px;
            font-size: 24px
        }

        .dialog p {
            margin: 0 0 36px;
            color: #707070;
            font-size: 15px
        }

        .start {
            display: block;
            padding: 14px;
            border-radius: 24px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-weight: bold
        }

        @media(max-width:850px) {
            .checkout {
                grid-template-columns: 1fr;
                gap: 36px
            }

            .summary {
                min-height: 0
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
                margin-bottom: 55px;
                font-size: 36px
            }

            .methods,
            .pair {
                grid-template-columns: 1fr
            }

            .checkout {
                padding-bottom: 50px
            }

            .dialog {
                padding: 36px 25px
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
    <main class="container">
        <section class="hero">Check out</section>
        <section class="checkout">
            <form id="payment-form">
                <h1>Select A Payment Method</h1>
                <div class="methods"><label class="method"><input type="radio" name="payment" checked><strong>▣</strong>Card</label><label class="method"><input type="radio" name="payment"><strong>PayPal</strong>PayPal</label><label class="method"><input type="radio" name="payment"><strong>G Pay</strong>Google Pay</label></div><label class="field">Cardholder Name<input required placeholder="Albity Fesal"></label><label class="field">Card Number<input required inputmode="numeric" placeholder="1234 1234 1234 1234"></label>
                <div class="pair"><label class="field">Expiration<input required placeholder="MM / YY"></label><label class="field">CVC<input required inputmode="numeric" placeholder="CVC"></label></div>
            </form>
            <aside class="summary">
                <h2>Summary</h2>
                <div class="course"><img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=300&q=85" alt="TCWTIR">
                    <div><strong>TCWTIR</strong>
                        <p>▱ 12 lessons &nbsp; ◷ 14 h : 30 m</p>
                        <p>♙ Albity Fesal<br><small>Coach</small></p>
                    </div>
                </div>
                <div class="totals">
                    <div class="line"><span>Amount</span><b>﷼ 20</b></div>
                    <div class="line"><span>Discount</span><b>00</b></div>
                    <div class="line total"><span>Total (1 programme)</span><b>﷼ 20</b></div>
                </div><button class="pay" form="payment-form" type="submit">♙ &nbsp; Pay &nbsp; ﷼ 20</button>
            </aside>
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
    <div class="modal" id="success" role="dialog" aria-modal="true">
        <div class="dialog">
            <div class="tick">✓</div>
            <h2>Congratulations!</h2>
            <p>You’ve Successfully Joined The TCWTIR Program.</p><a class="start" href="{{ route('programmes.details') }}">Start Your Learning</a>
        </div>
    </div>
    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('success').classList.add('open')
        })
    </script>
</body>

</html>