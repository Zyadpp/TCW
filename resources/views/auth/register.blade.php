<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | TCW</title>

    <style>
        /* =========================
           Global
        ========================== */

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


        /* =========================
           Auth Stage
        ========================== */

        .auth-stage {
            position: relative;

            width: 766px;
            height: 891px;
            margin: 45px auto 65px;
        }


        /* =========================
           Register Card
        ========================== */

        .register-card {
            position: absolute;
            inset: 0 auto auto 0;

            width: 766px;
            height: 891px;

            padding: 68px 62px 35px;

            background: #fff;

            transform: scale(var(--page-scale, 1));
            transform-origin: top left;
        }


        /* =========================
           Logo
        ========================== */

        .register-logo {
            display: block;

            width: 200px;
            height: 152px;

            margin: 0 auto 32px;

            object-fit: contain;
        }


        /* =========================
           Title
        ========================== */

        h1 {
            margin: 0 0 43px;

            font-size: 47px;
            font-weight: 500;
            line-height: 1;

            text-align: center;
        }


        /* =========================
           Form Fields
        ========================== */

        .field-wrap {
            position: relative;

            margin-bottom: 24px;
        }

        .field {
            width: 100%;
            height: 70px;
            padding: 0 23px;
            border: 0;
            border-radius: 28px;
            outline: 0;
            background: #f5f5f5;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.035);
            color: #333;
            font-size: 27px;
        }

        .field:focus {
            box-shadow: 0 0 0 3px rgba(190, 145, 68, 0.22);
        }

        .field::placeholder {
            color: #777;
        }


        /* =========================
           Password Fields
        ========================== */

        .field-wrap:has(.password-toggle) .field {
            padding-right: 58px;
        }

        .password-toggle {
            position: absolute;

            top: 50%;
            right: 22px;

            transform: translateY(-50%);

            padding: 4px;

            border: 0;

            background: transparent;

            color: #777;

            cursor: pointer;

            line-height: 0;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }


        /* =========================
           Register Button
        ========================== */

        .register-button {
            width: 100%;
            height: 73px;

            margin-top: 21px;

            border: 0;
            border-radius: 40px;

            background: #000;
            color: #fff;

            font-size: 18px;
            font-weight: 600;

            cursor: pointer;
        }

        .register-button:hover {
            background: #bd9147;
        }


        /* =========================
           Login Link
        ========================== */

        .login-link {
            margin: 24px 0 0;

            text-align: center;

            font-size: 16px;
        }

        .login-link a {
            color: #000;
            font-weight: 600;
        }


        /* =========================
           Validation Errors
        ========================== */

        .form-errors {
            margin: -14px 0 20px;

            padding: 12px 16px;

            border-radius: 10px;

            background: #fff0f0;
            color: #bf4d4d;

            font-size: 13px;
        }


        /* =========================
           Mobile
        ========================== */

        @media (max-width: 600px) {

            body {
                padding: 20px 12px;
            }

            .register-card {
                width: 100%;
                min-height: 0;

                padding: 48px 25px 35px;
            }

            .register-logo {
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

        <main class="register-card">

            <!-- Logo -->
            <img
                class="register-logo"
                src="{{ asset('images/logo.png') }}"
                alt="The Certain Way">


            <!-- Page Title -->
            <h1>Register</h1>


            <!-- Register Form -->
            <form
                action="{{ route('register.post') }}"
                method="POST">

                @csrf


                <!-- Errors -->
                @if ($errors->any())
                <div class="form-errors">
                    {{ $errors->first() }}
                </div>
                @endif


                <!-- Full Name -->
                <div class="field-wrap">
                    <input
                        class="field"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Full Name"
                        autocomplete="name"
                        required>
                </div>


                <!-- Email -->
                <div class="field-wrap">
                    <input
                        class="field"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        autocomplete="email"
                        required>
                </div>


                <!-- Phone -->
                <div class="field-wrap">
                    <input
                        class="field"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Phone Number"
                        autocomplete="tel"
                        required>
                </div>


                <!-- Password -->
                <div class="field-wrap">

                    <input
                        class="field"
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        autocomplete="new-password"
                        required>

                    <button
                        class="password-toggle"
                        type="button"
                        aria-label="Show password"
                        data-password-toggle="password">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5">
                            <path d="M3 3l18 18" />
                            <path d="M10.6 10.7a2 2 0 002.7 2.7" />
                            <path d="M9.9 5.1A10.9 10.9 0 0112 5c5.5 0 9.4 5.3 9.4 7s-1.5 3.8-3.8 5.2" />
                            <path d="M6.2 6.2C3.9 7.7 2.6 10.3 2.6 12c0 1.7 3.9 7 9.4 7 1.2 0 2.3-.3 3.3-.7" />
                        </svg>
                    </button>

                </div>


                <!-- Confirm Password -->
                <div class="field-wrap">

                    <input
                        class="field"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Retype Password"
                        autocomplete="new-password"
                        required>

                    <button
                        class="password-toggle"
                        type="button"
                        aria-label="Show password"
                        data-password-toggle="password_confirmation">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5">
                            <path d="M3 3l18 18" />
                            <path d="M10.6 10.7a2 2 0 002.7 2.7" />
                            <path d="M9.9 5.1A10.9 10.9 0 0112 5c5.5 0 9.4 5.3 9.4 7s-1.5 3.8-3.8 5.2" />
                            <path d="M6.2 6.2C3.9 7.7 2.6 10.3 2.6 12c0 1.7 3.9 7 9.4 7 1.2 0 2.3-.3 3.3-.7" />
                        </svg>
                    </button>

                </div>


                <!-- Register Button -->
                <button
                    class="register-button"
                    type="submit">
                    Register
                </button>

            </form>


            <!-- Login Link -->
            <p class="login-link">
                Have an account?
                <a href="{{ route('admin.login') }}">Log in</a>
            </p>

        </main>

    </div>


    <script>
        /* =========================
           Show / Hide Password
        ========================== */

        document
            .querySelectorAll('[data-password-toggle]')
            .forEach((button) => {

                button.addEventListener('click', () => {

                    const input = document.getElementById(
                        button.dataset.passwordToggle
                    );

                    input.type =
                        input.type === 'password' ?
                        'text' :
                        'password';

                    button.setAttribute(
                        'aria-label',
                        input.type === 'password' ?
                        'Show password' :
                        'Hide password'
                    );

                });

            });


        /* =========================
           Responsive Scaling
        ========================== */

        (() => {

            const stage = document.querySelector('.auth-stage');
            const card = document.querySelector('.register-card');

            const resize = () => {

                const scale = Math.min(
                    1,
                    (window.innerWidth - 40) / 766,
                    (window.innerHeight - 150) / 891
                );

                stage.style.width = `${766 * scale}px`;
                stage.style.height = `${891 * scale}px`;

                card.style.setProperty(
                    '--page-scale',
                    scale
                );
            };

            window.addEventListener('resize', resize);

            resize();

        })();
    </script>

</body>

</html>