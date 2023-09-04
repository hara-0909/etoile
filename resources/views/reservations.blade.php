<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css')  }}">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <title>予約一覧</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
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
<h1>予約一覧</h1>

  <!-- データ参照 -->
  <div class="tableContainer">
  <table border="1" class="datatable">
    <tr>
      <th>システムID</th>
      <th>予約者</th>
      <th>施術ID</th>
      <th>開始時刻</th>
      <th></th>
      <th></th>
    </tr>

    @foreach($reservations as $reservation)
    <tr class="table-item">
        <th>{{ $reservation->id }}</th>
        <th>{{ $reservation->name }}</th>
        <th>{{ $reservation->room_id }}</th>
        <th>{{ $reservation->starts_at }}</th>
        <th><a href="/edit/?id={{ $reservation->id }}">編集</a></th>
        <th><a href="/admin_delete/{{ $reservation->id }}" onclick="return confirm('本当に削除しますか？')">削除</a></th>

    </tr>
    @endforeach
  </table>
  <a class="return" href="{{ route('admin.Dashboard') }}">管理者画面へ戻る</a>
</div>
</body>