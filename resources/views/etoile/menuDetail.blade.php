@extends('layouts.app')

@section('content')
    <body class="menuDetail">

        <div>
            <h1 class="menuTitle">施術ご紹介</h1>

                <div class="menu_detail">
                    <div class="detail">
                        <label>施術概要①</label><br>
                        <a>~~~~~~~EBIという機械を使った施術~~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br></a>
                    </div>
                    <div class="detail">
                        <label>施術概要②</label><br>
                        <a>~~~~~~~~KANIという機械を使った施術~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br></a>
                    </div>
                    <div class="detail">
                        <label>施術概要③</label><br>
                        <a>~~~~~~~~TAKOという機械を使った施術~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br>
                            ~~~~~~~~~~~~~~~~~~~~~~~~~<br></a>
                    </div>
                </div>
            

        </div>
        <a class="return" href="{{ route('Top') }}">戻る</a>

    </body>
    @endsection
