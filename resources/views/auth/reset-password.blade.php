<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | TCW</title>
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
            margin: 47px auto 34px;
            font-size: 20px;
            line-height: 1.6
        }

        .field-wrap {
            position: relative;
            width: 490px;
            margin: 0 auto 24px
        }

        .field {
            width: 100%;
            height: 73px;
            padding: 0 58px 0 23px;
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            outline: 0;
            font-size: 18px
        }

        .field:focus {
            border-color: #bd9147;
            box-shadow: 0 0 0 3px rgba(190, 145, 68, .16)
        }

        .toggle {
            position: absolute;
            right: 19px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #777;
            cursor: pointer
        }

        .toggle svg {
            width: 20px;
            height: 20px
        }

        .error {
            width: 490px;
            margin: -10px auto 15px;
            color: #bf4d4d;
            font-size: 14px;
            text-align: left
        }

        .action {
            position: absolute;
            bottom: 81px;
            left: 0;
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
    </style>
</head>

<body>
    <div class="stage">
        <main class="card"><img class="logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <h1>Reset Password</h1>
            <p class="description">Choose a new password for your account.</p>
            <form action="{{ route('password.update') }}" method="POST">@csrf<div class="field-wrap"><input class="field" id="password" type="password" name="password" placeholder="New Password" autocomplete="new-password" required><button class="toggle" type="button" data-toggle="password" aria-label="Show password"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 3l18 18M10.6 10.7a2 2 0 002.7 2.7M9.9 5.1A10.9 10.9 0 0112 5c5.5 0 9.4 5.3 9.4 7s-1.5 3.8-3.8 5.2M6.2 6.2C3.9 7.7 2.6 10.3 2.6 12c0 1.7 3.9 7 9.4 7 1.2 0 2.3-.3 3.3-.7" />
                        </svg></button></div>
                <div class="field-wrap"><input class="field" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required><button class="toggle" type="button" data-toggle="password_confirmation" aria-label="Show password"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 3l18 18M10.6 10.7a2 2 0 002.7 2.7M9.9 5.1A10.9 10.9 0 0112 5c5.5 0 9.4 5.3 9.4 7s-1.5 3.8-3.8 5.2M6.2 6.2C3.9 7.7 2.6 10.3 2.6 12c0 1.7 3.9 7 9.4 7 1.2 0 2.3-.3 3.3-.7" />
                        </svg></button></div>@error('password')<p class="error">{{ $message }}</p>@enderror<button class="action" type="submit">Reset Password</button>
            </form>
        </main>
    </div>
    <script>
        document.querySelectorAll('[data-toggle]').forEach(b => b.addEventListener('click', () => {
            const i = document.getElementById(b.dataset.toggle);
            i.type = i.type === 'password' ? 'text' : 'password'
        }));
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