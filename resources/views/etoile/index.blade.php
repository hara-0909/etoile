@extends('layouts.app')

    <!-- <header>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </header>  -->
    @section('content')
        <div class="top-concept">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="for_admin">
                <a href="{{ route('Toadmin') }}">管理者はこちらから</a>
            </div>


                <img class="concept" src="{{ asset('etoile/img/etoileロゴ.png')}}">
                <p class="concept">〜CONCEPT〜</p>
                <a class="concept">ずっと綺麗が続くように<br>
                    年齢や男女を問わずに 「通いやすさ」「続けやすさ」を大切に</a>
        </div><!-- top-concept -->

        <div class="menu">
            <ul>
                <li class="menu-list">施術概要①</li>
                <li class="menu-list">施術概要②</li>
                <li class="menu-list">施術概要③</li>
            </ul>
            <ul>
                <button><a href="{{ route('menuDetail') }}">施術詳細はこちら</a></button>
            </ul>
        </div>
    @endsection