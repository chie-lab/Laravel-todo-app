# Blade テンプレート

## 概要

Laravel 標準のテンプレートエンジン。`resources/views/` に `.blade.php` ファイルとして配置する。PHP コードを直接書くより簡潔な構文を提供し、XSS 対策のエスケープも自動で行う。

## 変数の出力

```blade
{{-- エスケープあり（推奨） --}}
{{ $title }}

{{-- エスケープなし（信頼できるデータのみ使用） --}}
{!! $html !!}
```

## コメント

```blade
{{-- これはコメントです（HTMLに出力されない） --}}
```

## 制御構文

### 条件分岐

```blade
@if ($tasks->isEmpty())
    <p>タスクはありません。</p>
@elseif ($tasks->count() < 5)
    <p>タスクが少ないです。</p>
@else
    <p>タスクがあります。</p>
@endif
```

```blade
@unless ($user->isAdmin())
    <p>管理者ではありません。</p>
@endunless
```

### ループ

```blade
@foreach ($tasks as $task)
    <li>{{ $task->title }}</li>
@endforeach

@forelse ($tasks as $task)
    <li>{{ $task->title }}</li>
@empty
    <p>タスクはありません。</p>
@endforelse
```

ループ内では `$loop` 変数が使える:

```blade
@foreach ($tasks as $task)
    @if ($loop->first)
        <p>最初の要素</p>
    @endif
    {{ $loop->index }}  {{-- 0始まりのインデックス --}}
    {{ $loop->iteration }}  {{-- 1始まりの番号 --}}
    {{ $loop->count }}  {{-- 総件数 --}}
@endforeach
```

## レイアウト

### 親テンプレート（layouts/app.blade.php）

```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My App')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

### 子テンプレート

```blade
@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')
    <h1>タスク一覧</h1>
    @foreach ($tasks as $task)
        <p>{{ $task->title }}</p>
    @endforeach
@endsection
```

## コンポーネント

再利用可能なパーツを定義できる。

```bash
php artisan make:component Alert
```

`resources/views/components/alert.blade.php`:

```blade
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>
```

使用側:

```blade
<x-alert type="success">
    保存しました。
</x-alert>
```

## フォーム

```blade
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <input type="text" name="title" value="{{ old('title') }}">

    @error('title')
        <span>{{ $message }}</span>
    @enderror

    <button type="submit">保存</button>
</form>
```

PUT/DELETE は HTML フォームで送れないため `@method` を使う:

```blade
<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')
    ...
</form>
```

## インクルード

```blade
@include('partials.header')

{{-- 変数を渡す --}}
@include('partials.alert', ['type' => 'success', 'message' => '成功'])
```
