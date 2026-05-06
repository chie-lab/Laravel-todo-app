# Todo登録できるようになるまで

作成日: 2026-05-06

## 実施したこと

1. Todoの永続化に必要なDBテーブルを追加
- マイグレーションを作成し、todosテーブルを追加。
- カラムは id, title, timestamps の最小構成。

2. Todoモデルを追加
- Eloquentモデル Todo を作成。
- mass assignment 用に title を fillable に設定。

3. 画面表示と登録処理を実装
- TodoController を作成。
- index: Todo一覧を新しい順で取得して表示。
- store: バリデーション（title 必須、文字列、255文字以内）後に保存。
- 登録後はトップ画面へリダイレクトし、成功メッセージを表示。

4. ルーティングをTodoアプリ向けに変更
- GET / を Todo一覧画面に変更。
- POST /todos でTodo登録を受け付けるように設定。

5. メイン画面（Blade）をTodo画面に差し替え
- Todo入力フォームを配置。
- バリデーションエラー表示を追加。
- 登録済みTodo一覧を表示。
- データがないときの空状態メッセージを表示。

6. スタイルの外部ファイル化
- もともとのインライン style を削除。
- CSSを public/css/todos.css に移動。
- Bladeから外部CSSを読み込むように変更。

## 変更ファイル

- src/database/migrations/2026_05_06_000003_create_todos_table.php
- src/app/Models/Todo.php
- src/app/Http/Controllers/TodoController.php
- src/routes/web.php
- src/resources/views/todos/index.blade.php
- src/public/css/todos.css

## 確認内容

- 追加ファイルの静的エラーがないことを確認。
- コンテナ内で migration:status を確認し、todosマイグレーションが Ran になっていることを確認。
- トップ画面のHTMLに Todo画面のタイトルと外部CSSリンクが出力されることを確認。

## 現在の到達点

- メイン画面でTodoを登録できる。
- 登録したTodoを同画面で一覧表示できる。
- スタイリングは外部CSSファイル管理になっている。
