<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $purpose === 'verify' ? 'Verification' : 'Forgot Password' }} | TCW</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 66px 20px;
            display: grid;
            place-items: center;
            background: #f4ead9;
            font-family: Arial, sans-serif;
            color: #050505;
            overflow: hidden;
        }

        .stage {
            position: relative;
            width: 766px;
            height: 891px;
        }

        .card {
            position: absolute;
            inset: 0 auto auto 0;
            width: 766px;
            height: 891px;
            padding: 68px 62px 35px;
            background: #fff;
            transform: scale(var(--scale, 1));
            transform-origin: top left;
            text-align: center;
        }

        .logo {
            display: block;
            width: 190px;
            height: 142px;
            margin: 0 auto 32px;
            object-fit: contain;
        }

        h1 {
            margin: 0;
            font-size: 47px;
            font-weight: 500;
            line-height: 1;
        }

        .description {
            width: 540px;
            margin: 47px auto 34px;
            font-size: 20px;
            line-height: 1.6;
        }

        .email-field {
            position: relative;
            width: 490px;
            margin: 0 auto;
        }

        .email-field svg {
            position: absolute;
            left: 23px;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            color: #777;
        }

        input {
            width: 100%;
            height: 73px;
            padding: 0 25px 0 63px;
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            outline: 0;
            font-size: 20px;
        }

        input:focus {
            border-color: #bd9147;
            box-shadow: 0 0 0 3px rgba(190, 145, 68, .16);
        }

        .error {
            width: 490px;
            margin: 14px auto 0;
            color: #bf4d4d;
            font-size: 14px;
        }

        .action {
            width: 100%;
            height: 73px;
            position: absolute;
            left: 0;
            bottom: 81px;
            border: 0;
            border-radius: 40px;
            background: #000;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .action:hover {
            background: #bd9147;
        }

        .resend {
            position: absolute;
            bottom: 37px;
            left: 0;
            width: 100%;
            margin: 0;
            font-size: 16px;
            color: #777;
        }

        .resend button {
            border: 0;
            padding: 0;
            background: transparent;
            color: #000;
            font: inherit;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="stage">
        <main class="card"><img class="logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <h1>{{ $purpose === 'verify' ? 'Verification' : 'Forgot Password' }}</h1>
            <p class="description">{{ $purpose === 'verify' ? 'Enter your email address below and we’ll send you a verification code to confirm it’s you.' : 'Enter the email address where we will send the OTP to reset your password' }}</p>
            <form action="{{ $purpose === 'verify' ? route('verification.send') : route('password.email') }}" method="POST">@csrf<div class="email-field"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="m3 6 9 7 9-7" />
                    </svg><input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Enter your email" autocomplete="email" required></div>@error('email')<p class="error">{{ $message }}</p>@enderror<button class="action" type="submit">Continue</button></form>
            <p class="resend">Don’t receive code ? <button type="submit" form="resend-form">Re-send</button></p>
            <form id="resend-form" action="{{ route('verification.resend') }}" method="POST">@csrf</form>
        </main>
    </div>
    <script>
        (() => {
            const s = document.querySelector('.stage'),
                c = document.querySelector('.card');
            const r = () => {
                const z = Math.min(1, (innerWidth - 40) / 766, (innerHeight - 150) / 891);
                s.style.width = `${766*z}px`;
                s.style.height = `${891*z}px`;
                c.style.setProperty('--scale', z)
            };
            addEventListener('resize', r);
            r()
        })()
    </script>
</body>

</html>