<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification | TCW</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 66px 20px;
            display: grid;
            place-items: center;
            background: #f4ead9;
            color: #050505;
            font-family: Arial, sans-serif;
            overflow: hidden
        }

        .stage {
            position: relative;
            width: 766px;
            height: 891px
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
            text-align: center
        }

        .logo {
            display: block;
            width: 190px;
            height: 142px;
            margin: 0 auto 32px;
            object-fit: contain
        }

        h1 {
            margin: 0;
            font-size: 47px;
            font-weight: 500;
            line-height: 1
        }

        .description {
            margin: 47px auto 32px;
            font-size: 20px;
            line-height: 1.6
        }

        .description strong {
            display: block
        }

        .otp {
            display: flex;
            justify-content: center;
            gap: 16px
        }

        .otp input {
            width: 96px;
            height: 96px;
            border: 0;
            border-radius: 15px;
            outline: 0;
            background: #f1f1f1;
            text-align: center;
            font-family: Georgia, serif;
            font-size: 26px
        }

        .otp input:focus {
            box-shadow: 0 0 0 3px rgba(190, 145, 68, .3)
        }

        .error {
            margin: 15px 0 0;
            color: #bf4d4d;
            font-size: 14px
        }

        .timer {
            margin: 27px 0 0;
            color: #888;
            font-size: 14px
        }

        .action {
            position: absolute;
            left: 0;
            bottom: 81px;
            width: 100%;
            height: 73px;
            border: 0;
            border-radius: 40px;
            background: #000;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer
        }

        .action:hover {
            background: #bd9147
        }

        .resend {
            position: absolute;
            bottom: 37px;
            left: 0;
            width: 100%;
            margin: 0;
            color: #777;
            font-size: 16px
        }

        .resend button {
            border: 0;
            padding: 0;
            background: transparent;
            color: #000;
            font: inherit;
            cursor: pointer
        }
    </style>
</head>

<body>
    <div class="stage">
        <main class="card"><img class="logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <h1>Verification</h1>
            <p class="description">OTP has been sent sent to<strong>{{ $email }}</strong></p>
            <form action="{{ route('verification.verify') }}" method="POST">@csrf<div class="otp">@for($i=0;$i<4;$i++)<input name="otp[]" inputmode="numeric" pattern="[0-9]*" maxlength="1" aria-label="Code digit {{ $i + 1 }}" required>@endfor</div>@error('otp')<p class="error">{{ $message }}</p>@enderror<p class="timer" id="timer">10:00 Sec</p><button class="action" type="submit">Verify</button></form>
            <p class="resend">Don’t receive code ? <button type="submit" form="resend-form">Re-send</button></p>
            <form id="resend-form" action="{{ route('verification.resend') }}" method="POST">@csrf</form>
        </main>
    </div>
    <script>
        const inputs = [...document.querySelectorAll('.otp input')];
        inputs.forEach((el, i) => el.addEventListener('input', () => {
            el.value = el.value.replace(/\D/g, '').slice(0, 1);
            if (el.value && inputs[i + 1]) inputs[i + 1].focus()
        }));
        inputs.forEach((el, i) => el.addEventListener('keydown', e => {
            if (e.key === 'Backspace' && !el.value && inputs[i - 1]) inputs[i - 1].focus()
        }));
        let left = 600,
            t = document.querySelector('#timer');
        setInterval(() => {
            left = Math.max(0, left - 1);
            t.textContent = `${String(Math.floor(left/60)).padStart(2,'0')}:${String(left%60).padStart(2,'0')} Sec`
        }, 1000);
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