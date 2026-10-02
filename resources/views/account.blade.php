<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Account | TCW</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            background: #f4ead9;
            color: #050505;
            font-family: Arial, sans-serif;
        }

        main {
            width: min(560px, calc(100% - 40px));
            padding: 52px;
            text-align: center;
            background: #fff;
        }

        img {
            width: 150px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 18px;
        }

        h1 {
            margin: 0 0 14px;
            font-size: 36px;
            font-weight: 500;
        }

        p {
            margin: 0;
            color: #666;
            font-size: 16px;
        }

        form {
            margin-top: 38px;
        }

        button {
            width: 100%;
            height: 58px;
            border: 0;
            border-radius: 30px;
            background: #000;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #bd9147;
        }
    </style>
</head>

<body>
    <main>
        <img src="{{ asset('images/logo.png') }}" alt="The Certain Way">
        <h1>Welcome, {{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        @if (session('success'))<p>{{ session('success') }}</p>@endif
        <form action="{{ route('support.store') }}" method="POST" enctype="multipart/form-data">@csrf<input name="title" placeholder="Support request title" required><input name="type" placeholder="Type" required><input type="file" name="attachment"><button>Send support request</button></form>
        <form action="{{ route('comments.store') }}" method="POST">@csrf<input name="body" placeholder="Leave a comment" required><button>Send comment</button></form>
        <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Log out</button></form>
    </main>
</body>

</html>
