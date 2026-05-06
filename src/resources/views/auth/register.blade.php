@extends('layouts.app')

@section('title', '新規登録 — Todo App')

@section('content')
    <div class="container">
        <div class="card auth-card">
            <h1>新規登録</h1>
            <p class="subtitle">アカウントを作成してTodo管理を始めましょう。</p>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="name">名前</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                        autofocus
                    >
                </div>

                <div class="field">
                    <label for="email">メールアドレス</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                </div>

                <div class="field">
                    <label for="password">パスワード（8文字以上）</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <div class="field">
                    <label for="password_confirmation">パスワード（確認）</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn-block">登録する</button>
            </form>

            <p class="auth-link">
                すでにアカウントをお持ちの方は
                <a href="{{ route('login') }}">ログイン</a>
            </p>
        </div>
    </div>
@endsection
