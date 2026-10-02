    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log in | TCW</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                min-height: 100vh;
                margin: 0;
                display: grid;
                place-items: center;
                padding: 66px 24px;
                background: #f1e7d5;
                color: #080808;
                font-family: Arial, Helvetica, sans-serif;
            }

            .login-card {
                width: min(100%, 766px);
                min-height: 890px;
                padding: 72px 62px 36px;
                background: #fff;
            }

            .brand {
                display: block;
                width: 185px;
                height: 130px;
                margin: 0 auto 38px;
                object-fit: contain;
            }

            h1 {
                margin: 0 0 78px;
                text-align: center;
                font-size: 48px;
                line-height: 1;
                font-weight: 500;
            }

            .field {
                width: 100%;
                height: 90px;
                margin-bottom: 39px;
                padding: 0 32px;
                border: 0;
                border-radius: 38px;
                outline: none;
                background: #f7f7f7;
                box-shadow: 0 9px 24px rgb(0 0 0 / 3%);
                color: #171717;
                font: 16px Arial, sans-serif;
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
                margin: 4px 27px 154px;
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

            .forgot {
                color: #000;
                text-decoration: none;
            }

            .forgot:hover,
            .register a:hover {
                text-decoration: underline;
            }

            .submit {
                width: 100%;
                height: 73px;
                border: 0;
                border-radius: 38px;
                background: #000;
                color: #fff;
                cursor: pointer;
                font: 600 18px Arial, sans-serif;
            }

            .submit:hover {
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
                color: inherit;
                font-weight: 600;
                text-decoration: underline;
            }

            @media (max-width: 600px) {
                body {
                    padding: 20px 12px;
                }

                .login-card {
                    min-height: auto;
                    padding: 52px 25px 35px;
                }

                .brand {
                    width: 150px;
                    height: 100px;
                    margin-bottom: 32px;
                }

                h1 {
                    margin-bottom: 55px;
                    font-size: 42px;
                }

                .field {
                    height: 62px;
                    margin-bottom: 26px;
                    padding: 0 24px;
                }

                .options {
                    margin: 2px 4px 75px;
                    font-size: 14px;
                }

                .remember {
                    gap: 8px;
                }

                .submit {
                    height: 63px;
                }
            }
        </style>
    </head>

    <body>
        <main class="login-card">
            <img class="brand" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <h1>Log in</h1>

            @if (session('success'))
            <div class="success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <input class="field" type="email" name="email" value="{{ old('email') }}" placeholder="Email or phone number" autocomplete="username" required>
                <input class="field" type="password" name="password" placeholder="Password" autocomplete="current-password" required>

                @if ($errors->any())
                <div class="errors">{{ $errors->first() }}</div>
                @endif

                <div class="options">
                    <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
                    <a class="forgot" href="{{ route('password.request') }}">Forgot Password?</a>
                </div>

                <button class="submit" type="submit">Log in</button>
            </form>

            <p class="register">Don’t have an account? <a href="{{ route('register') }}">Register Now</a></p>
        </main>
    </body>

    </html>