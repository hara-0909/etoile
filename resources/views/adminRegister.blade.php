<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')  }}">
    <link rel="icon" type="image/png" href="{{ asset('etoile/img')  }}g">

    <title>管理者新規登録</title>
</head>

<body class="antialiased">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif

    @isset($registered)
        <div>登録に成功しました。メールアドレス：{{ $registered_email }}</div>
    @endisset
    <div class="cover_adminlogin">
        <form class="adminlogin" method="POST" action="{{ route('admin.register') }}">
            @csrf
            <h1>管理者新規登録</h1>
                <label for="name">Name</label>
                <input type="text" id="name" name="name">

                <label for="email">Mail</label>
                <input type="text" id="email" name="email">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="password_confirmation">Password(confirmed)</label>
                <input type="password" id="password_confirmation" name="password_confirmation">

                <label>AdminLevel</label>
                <!-- <input type="text" id="admin_level" name="admin_level"> -->
                    <select class="adminRegister_select" name="admin_level">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select><br>

                <button type="submit">Register</button><br>
                <button><a class="return" href="{{ route('adminRegister_login') }}">Login</a></button><br>

        </form>
    </div>
</body>
</html>
