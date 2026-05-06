# Todo完了チェック機能追加まで

作成日: 2026-05-06

## 実施したこと

1. 完了状態を保存するDBカラムを追加
- todosテーブルに is_completed (boolean) を追加。
- デフォルト値は false。
- 追加用マイグレーションを作成し適用。

2. Todoモデルを更新
- fillable に is_completed を追加。
- casts で is_completed を boolean に設定。

3. 完了状態更新処理を追加
- TodoController に updateCompletion を追加。
- リクエスト値 is_completed を required + boolean でバリデーション。
- 対象Todoを更新し、一覧画面へリダイレクト。

4. ルーティングを追加
- PATCH /todos/{todo}/completion を追加。
- 名前付きルート todos.update-completion を設定。

5. 一覧画面にチェックUIを追加
- 各Todo行に完了チェックボックスを追加。
- チェック操作時にフォーム自動送信して完了状態を更新。
- hidden の is_completed=0 と checkbox の is_completed=1 でON/OFFを表現。

6. 完了状態の見た目を調整
- 完了時のドット色を変更。
- 完了時のタイトルを打ち消し線＋薄い文字色に変更。
- チェックボックス周辺のスタイルを追加。

## 変更ファイル

- src/database/migrations/2026_05_06_000004_add_is_completed_to_todos_table.php
- src/app/Models/Todo.php
- src/app/Http/Controllers/TodoController.php
- src/routes/web.php
- src/resources/views/todos/index.blade.php
- src/public/css/todos.css

## 確認内容

- 変更ファイルの静的エラーがないことを確認。
- マイグレーションが Ran になっていることを確認。
- トップ画面のHTMLに完了更新用フォームとチェックボックスが出力されることを確認。

## 現在の到達点

- Todoの追加に加えて、完了/未完了の切り替えができる。
- 完了状態はDBに保存され、画面表示にも反映される。
