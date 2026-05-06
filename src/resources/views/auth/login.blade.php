@extends('layouts.app')

@section('title', 'ログイン — Todo App')

@section('content')
    <div class="container">
        <div class="card auth-card">
            <h1>ログイン</h1>
            <p class="subtitle">メールアドレスとパスワードでログインしてください。</p>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="auth-form" action="{{ route('login') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="email">メールアドレス</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                </div>

                <div class="field">
                    <label for="password">パスワード</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn-block">ログイン</button>
            </form>

            <p class="auth-link">
                アカウントをお持ちでない方は
                <a href="{{ route('register') }}">新規登録</a>
            </p>
        </div>
    </div>
@endsection
