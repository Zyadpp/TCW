<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | TCW Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: #f4ead9;
            color: #050505;
            font-family: Arial, sans-serif;
        }

        .auth-stage {
            position: relative;
            width: 766px;
            height: 891px;
            margin: 45px auto 65px;
        }

        .login-card {
            position: absolute;
            inset: 0 auto auto 0;
            width: 766px;
            height: 891px;
            padding: 68px 62px 35px;
            background: #fff;
            transform: scale(var(--page-scale, 1));
            transform-origin: top left;
        }

        .login-logo {
            display: block;
            width: 200px;
            height: 152px;
            margin: 0 auto 32px;
            object-fit: contain;
        }

        h1 {
            margin: 0 0 43px;
            text-align: center;
            font-size: 60px;
            line-height: 1;
            font-weight: 500;
        }

        .field {
            width: 100%;
            height: 70px;
            margin-bottom: 24px;
            padding: 0 23px;
            border: 0;
            border-radius: 28px;
            outline: 0;
            background: #f5f5f5;
            box-shadow: 0 12px 30px rgb(0 0 0 / 3.5%);
            color: #333;
            font-size: 27px;
        }

        .field::placeholder {
            color: #777;
        }

        .field:focus {
            box-shadow: 0 0 0 3px rgb(197 155 77 / 35%);
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0 0 84px;
            font-size: 16px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #777;
            cursor: pointer;
        }

        .remember input {
            width: 20px;
            height: 20px;
            margin: 0;
            accent-color: #c59b4d;
        }

        a {
            color: inherit;
        }

        .forgot {
            text-decoration: none;
        }

        .forgot:hover,
        .register a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            height: 73px;
            border: 0;
            border-radius: 38px;
            background: #000;
            color: #fff;
            cursor: pointer;
            font: 600 18px Arial, sans-serif;
        }

        button:hover {
            background: #252525;
        }

        .errors,
        .success {
            margin: -20px 0 25px;
            padding: 13px 18px;
            border-radius: 12px;
            font-size: 14px;
        }

        .errors {
            background: #fff0f0;
            color: #ae2424;
        }

        .success {
            background: #edf8ef;
            color: #216739;
        }

        .register {
            margin: 27px 0 0;
            text-align: center;
            font-size: 16px;
        }

        .register a {
            font-weight: 600;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .login-card {
                width: 100%;
                min-height: 0;
                padding: 48px 25px 35px;
            }

            .login-logo {
                width: 150px;
                height: 105px;
                margin-bottom: 30px;
            }

            h1 {
                font-size: 37px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-stage">
        <main class="login-card">
            <img class="login-logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <h1>Log in</h1>

            @if (session('success'))
            <div class="success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <input class="field" type="email" name="email" value="{{ old('email') }}" placeholder="Email address" autocomplete="username" required>
                <input class="field" type="password" name="password" placeholder="Password" autocomplete="current-password" required>

                @if ($errors->any())
                <div class="errors">{{ $errors->first() }}</div>
                @endif

                <div class="options">
                    <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
                    <a class="forgot" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>

                <button type="submit">Log in</button>
            </form>

            <p class="register">Don't have an account? <a href="{{ route('register') }}">Register Now</a></p>
        </main>
    </div>
    <script>
        (() => {
            const stage = document.querySelector('.auth-stage');
            const card = document.querySelector('.login-card');
            const resize = () => {
                const scale = Math.min(1, (window.innerWidth - 40) / 766, (window.innerHeight - 150) / 891);
                stage.style.width = `${766 * scale}px`;
                stage.style.height = `${891 * scale}px`;
                card.style.setProperty('--page-scale', scale);
            };
            window.addEventListener('resize', resize);
            resize();
        })();
    </script>
</body>

</html>