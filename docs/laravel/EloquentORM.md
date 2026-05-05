# Eloquent ORM

## 概要

Laravel 標準の ORM（Object-Relational Mapper）。DB テーブルをクラスとして扱い、SQL を直接書かずにデータ操作できる。

## モデルの作成

```bash
php artisan make:model Task
```

マイグレーションも同時に作成する場合:

```bash
php artisan make:model Task -m
```

## モデルの基本構造

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // 一括代入を許可するカラム
    protected $fillable = ['title', 'description', 'is_done'];
}
```

Eloquent はテーブル名をモデル名の複数形（`tasks`）と自動的に対応付ける。

## CRUD 操作

### 取得

```php
// 全件取得
$tasks = Task::all();

// 条件付き取得
$tasks = Task::where('is_done', false)->get();

// 1件取得（見つからなければ null）
$task = Task::find(1);

// 1件取得（見つからなければ 404）
$task = Task::findOrFail(1);

// 最初の1件
$task = Task::where('is_done', false)->first();

// 件数
$count = Task::count();
```

### 作成

```php
// create() を使う場合（$fillable の設定が必要）
$task = Task::create([
    'title' => 'タスクのタイトル',
    'is_done' => false,
]);

// インスタンスを作って save()
$task = new Task();
$task->title = 'タスクのタイトル';
$task->save();
```

### 更新

```php
// update() を使う
$task = Task::findOrFail(1);
$task->update(['title' => '新しいタイトル']);

// プロパティを直接変更して save()
$task->title = '新しいタイトル';
$task->save();
```

### 削除

```php
$task = Task::findOrFail(1);
$task->delete();

// ID 指定で削除
Task::destroy(1);
Task::destroy([1, 2, 3]);
```

## クエリビルダ

```php
Task::where('is_done', false)
    ->orderBy('created_at', 'desc')
    ->limit(10)
    ->get();
```

## リレーション

### 1対多（hasMany / belongsTo）

```php
// User モデル
public function tasks(): HasMany
{
    return $this->hasMany(Task::class);
}

// Task モデル
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
```

使用例:

```php
// ユーザーのタスクを取得
$tasks = $user->tasks;

// タスクのユーザーを取得
$user = $task->user;
```

### N+1 問題と Eager Loading

```php
// 悪い例（N+1）
$tasks = Task::all();
foreach ($tasks as $task) {
    echo $task->user->name; // ループのたびにクエリが発行される
}

// 良い例（Eager Loading）
$tasks = Task::with('user')->get();
foreach ($tasks as $task) {
    echo $task->user->name; // クエリは2回だけ
}
```

## タイムスタンプ

Eloquent は `created_at` / `updated_at` を自動管理する（デフォルト有効）。

```php
// 無効にする場合
public $timestamps = false;
```

## ソフトデリート

物理削除せず `deleted_at` に日時を記録する。

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
}
```

```php
$task->delete();           // deleted_at が記録される
Task::withTrashed()->get(); // 削除済みも含めて取得
$task->restore();           // 復元
$task->forceDelete();       // 物理削除
```
