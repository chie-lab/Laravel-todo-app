# Todo削除機能追加まで

作成日: 2026-05-06

## 実施したこと

1. Todo削除処理を追加
- TodoController に destroy アクションを追加。
- 受け取った Todo を delete し、一覧画面へリダイレクト。
- フラッシュメッセージ「Todoを削除しました。」を表示するようにした。

2. 削除用ルーティングを追加
- DELETE /todos/{todo} を追加。
- 名前付きルート todos.destroy を設定。

3. 一覧画面に削除ボタンを追加
- 各Todo行の右側に削除フォームを追加。
- method spoofing（@method('DELETE')）で削除リクエストを送信。
- 既存の完了チェックUIと共存する構成にした。

4. 削除ボタン用スタイルを追加
- 行内フォームのレイアウトを調整。
- 削除ボタンの色・枠・ホバー状態を追加。

## 変更ファイル

- src/app/Http/Controllers/TodoController.php
- src/routes/web.php
- src/resources/views/todos/index.blade.php
- src/public/css/todos.css

## 確認内容

- 変更ファイルの静的エラーがないことを確認。
- route:list で以下が登録されていることを確認。
  - DELETE todos/{todo} (todos.destroy)
- 画面HTML上で各Todoに削除フォームとDELETE指定が出力されることを確認。

## 現在の到達点

- Todoの追加ができる。
- Todoの完了/未完了を切り替えできる。
- Todoを一覧画面から削除できる。
