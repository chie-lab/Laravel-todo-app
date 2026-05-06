# Bladeテンプレートをレイアウト化しパーシャルに分割まで

作成日: 2026-05-06

## 実施したこと

1. 共通レイアウトを作成
- layouts/app.blade.php を新規作成。
- HTML全体、title、CSS読み込みを1か所に集約。
- 各画面は @extends('layouts.app') で継承し、@yield('content') に本文を差し込む構造にした。

2. 作成フォームをパーシャルに切り出し
- todos/partials/create-form.blade.php を新規作成。
- Todo入力フォームの HTML を分離。

3. Todo行をパーシャルに切り出し
- todos/partials/todo-item.blade.php を新規作成。
- 完了チェックボックス・ドット・タイトル・削除ボタンを含む1行分を分離。

4. アラート表示をパーシャルに切り出し
- todos/partials/alerts.blade.php を新規作成。
- 成功メッセージ（session('status')）とバリデーションエラー一覧を分離。
- アラートリスト内の ul/li が通常のTodo一覧スタイルの影響を受けないよう .alert-list スタイルを追加。

5. index.blade.php を整理
- HTML構造・アラート・フォーム・Todo行の直書きを削除。
- @extends/@include 中心の構成に置き換え。

## 変更ファイル

- src/resources/views/layouts/app.blade.php（新規）
- src/resources/views/todos/partials/create-form.blade.php（新規）
- src/resources/views/todos/partials/todo-item.blade.php（新規）
- src/resources/views/todos/partials/alerts.blade.php（新規）
- src/resources/views/todos/index.blade.php（更新）
- src/public/css/todos.css（更新）

## 確認内容

- 変更ファイルの静的エラーがないことを確認。
- 画面出力（タイトル・CSS・Todo行・削除フォーム）が正常に出ることをHTMLで確認。
- 機能（追加・完了切替・削除）は変更なし。

## 現在の到達点

- 機能は変えずにテンプレート構造を整理した。
- 追加画面や共通ヘッダーを加えたい場合も layouts/app.blade.php の編集だけで対応できる。
- 各パーシャルは独立しているため、変更箇所が明確で保守しやすい構成になった。
