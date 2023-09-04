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
    </head>
<script>
    function clickEvent() {
        window.confirm('更新してよろしいですか？');
    }
</script>
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


  <!-- <form method="post" action="{{ route('update') }}" novalidate> -->
    <!-- @csrf -->
    <div class="contactTitle">
    <h1>編集画面</h1>
    </div> 

    <div class="admin_edit">
        <form method="POST" action="{{ route('update', $reservations->id) }}">
        @csrf
        @method('PUT')

            <p class="edit_attention">編集完了後、更新ボタンを押してください。</p>

            <div class="edit_content">
                <a>施術<span class="red-point">*</span></a><br>
                <input type="radio" name="room_id" value="1" {{ old('room_id', $reservations['room_id']) == '1' ? 'checked' : '' }}> 施術1
                    <input type="radio" name="room_id" value="2" {{ old('room_id', $reservations['room_id']) == '2' ? 'checked' : '' }}> 施術2
                    <input type="radio" name="room_id" value="3" {{ old('room_id', $reservations['room_id']) == '3' ? 'checked' : '' }}> 施術3<br>
                    <!-- 他のオプションを追加 -->
                    @if ($errors->has('room_id'))
                    <p class="error-msg">{{$errors->first('room_id')}}</p><br>
                    @endif

                <a>開始時刻<span class="red-point">*</span></a><br>
                <input type="starts_at" class="" name="starts_at" value="{{ old('starts_at', $reservations['starts_at'])}}" required>
                @if ($errors->has('starts_at'))
                <p class="error-msg">{{$errors->first('starts_at')}}</p>
                @endif
            </div>

          <div class="button">
              <button onclick="clickEvent()" class="button-firm" type="submit" name="send" value="更新">更 新</button>
              <a class="button-back" name="action" href="{{ route('admin.Dashboard') }}">戻 る</a>
          </div>
        </form>
      </div>



</body>
</html>

