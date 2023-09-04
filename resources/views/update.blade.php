<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')  }}">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<body class="antialiased">
        <header>
            <div class="info">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="info">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">ログアウト</a>
                        <a class="dropdown-item" href="{{ route('admin.register') }}">アカウント作成</a>
                    </div>
                </div>
            </div>
        </header>
    <form method="post" action="reservations.php">
        <!-- <h1>お問い合わせ</h1> -->
        <div class="admin_update">
            <p class="form-text">
                編集内容を更新しました。
            </p>
            <a href="{{ route('reservations') }}">予約一覧へ戻る</a>
        </div>
    </form>

</body>
</html>


