<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')  }}">
        <link rel="icon" type="image/png" href="{{ asset('etoile/img')  }}g">

        <title>管理者ログイン</title>
    </head>
    <body class="antialiased">
        <header>
            <div class="info">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </header>
        @if ($errors->any())  {{--  エラーがあれば出力する --}}
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        <h1>管理者ログイン</h1>
        <div class="cover_adminlogin">
            <form class="adminlogin" method="POST" action="{{ route("admin.login") }}">  {{--  routeはここと同じ --}}
                @csrf
                    <label for="email">Mail：</label><br>
                    <input type="text" id="email" name="email"><br>
                    <label for="password">Password：</label><br>
                    <input type="password" id="password" name="password"><br>
                    <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>
