<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
@extends('layouts.app')

@section('content')

<body class="body_dash">

    <div class="dashboard">
        <h1>会員ページ</h1>
        <div class="dashboard_top">
        <div  class="dashbord_situ">
                <a>ご予約状況</a>
            </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ご予約日時</th>
                    <th>施術番号</th>
                    <th></th>
                    <!-- 他のカラムを追加 -->
                </tr>
            </thead>
            <tbody>
            @if(count($reservations) > 0)
            @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->starts_at }}</td>
                        <td>{{ $reservation->room_id }}</td>
                        <td><a href="{{ route('reservation_delete', ['id' => $reservation->id]) }}" type='submit' name='id' value="{{ $reservation->id }}" onclick="return confirm('キャンセルしてよろしいですか？')">ご予約キャンセル</a></td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        <td colspan="2">現在ご予約はありません</td>
                        <td></td>
                    </tr>
            @endif
            </tbody>
        </table>
            <div class="new_reservation">
                <a href="{{ route('reservation.index') }}">新規ご予約はこちら</a><br>
            </div>
        </div>
        <form method="POST" action="{{ route('deactivateAccount', ['userId' => Auth::user()->id]) }}" id="deactivateForm" class="taikai">
            @csrf
            <button type="button" onclick="confirmDeactivation()">退会する</button>
        </form>
    </div>

    <script>
        function confirmDeactivation() {
            if(confirm('本当に退会してよろしいですか？')) {
                document.getElementById('deactivateForm').submit();
            }
        }
    </script>

</body>

@endsection