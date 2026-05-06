# ログインユーザーのTodoだけを表示するようにするまで

作成日: 2026-05-06

## 実施したこと

1. todosテーブルに `user_id` カラムを追加
- マイグレーション `2026_05_06_000006_add_user_id_to_todos_table.php` を新規作成。
- `user_id` を `users.id` への外部キーとして追加。
- ユーザーが削除された場合はそのユーザーの Todo も自動削除（`cascadeOnDelete`）。
- 既存レコードに `user_id NOT NULL` 制約が掛かるため、マイグレーション前に既存 Todo を全件削除してから実行。

2. Todo モデルを更新
- `$fillable` に `user_id` を追加。
- `belongsTo(User::class)` リレーションを追加。

3. User モデルを更新
- `hasMany(Todo::class)` リレーションを追加。

4. TodoController を更新
- `index`：`Todo::query()` を `Auth::user()->todos()` に変更し、ログインユーザーのTodoだけを取得。
- `store`：`min('order')` の取得と `create()` をどちらも `Auth::user()->todos()` 経由に変更。`create()` 経由で呼ぶことで `user_id` が自動的にセットされる。
- `updateCompletion`：`abort_unless($todo->user_id === Auth::id(), 403)` を追加し、他人のTodoの完了状態を変更できないようにした。
- `destroy`：同様に `abort_unless` で所有権を確認してから削除。
- `reorder`：リクエストで送られてきた ID のうち、自分が所有するものだけ `order` を更新。他人の Todo の `order` は変更されない。

## 変更ファイル

- src/database/migrations/2026_05_06_000006_add_user_id_to_todos_table.php（新規）
- src/app/Models/Todo.php（更新）
- src/app/Models/User.php（更新）
- src/app/Http/Controllers/TodoController.php（更新）

## 確認内容

- `php artisan migrate` が正常終了（59.69ms DONE）。

## 現在の到達点

- 各ユーザーは自分が作成した Todo だけを閲覧・操作できる。
- 他人の Todo に対して完了切替・削除・並び替えを試みると 403 を返す。
- ユーザーアカウントを削除すると紐づく Todo も自動削除される。
