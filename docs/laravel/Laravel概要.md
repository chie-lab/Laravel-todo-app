# Laravel 概要

## Laravel とは

PHP 製の Web アプリケーションフレームワーク。「エレガントな構文」を掲げており、認証・ルーティング・ORM・テンプレートエンジンなど Web 開発に必要な機能を標準で備えている。

## アーキテクチャ

Laravel は **MVC（Model-View-Controller）** パターンを採用している。

| 層 | 役割 | 場所 |
|---|---|---|
| Model | データとビジネスロジック | `app/Models/` |
| View | 画面表示（Blade テンプレート） | `resources/views/` |
| Controller | リクエスト処理と Model/View の橋渡し | `app/Http/Controllers/` |

## リクエストのライフサイクル

```
ブラウザ
  └─ public/index.php                                 # エントリポイント
       └─ ルーティング                                 # routes/web.php
            └─ ミドルウェア                            # 認証・セッションなど
                 └─ コントローラー
                      └─ Model（DB操作）
                           └─ View（Blade）
                                └─ レスポンス
```

## ディレクトリ構成（主要部分）

```
app/
  Http/
    Controllers/    # コントローラー
    Middleware/     # ミドルウェア
  Models/           # Eloquent モデル
bootstrap/          # アプリ起動処理
config/             # 設定ファイル
database/
  migrations/       # マイグレーションファイル
  seeders/          # 初期データ投入
public/             # ドキュメントルート（index.php のみ公開）
resources/
  views/            # Blade テンプレート
routes/
  web.php           # Web ルート定義
  api.php           # API ルート定義
storage/            # ログ・キャッシュ・セッション
```

## Artisan コマンド

Laravel 付属の CLI ツール。

```bash
# 開発サーバー起動
php artisan serve

# ルート一覧表示
php artisan route:list

# コントローラー作成
php artisan make:controller TaskController

# モデル作成
php artisan make:model Task

# マイグレーションファイル作成
php artisan make:migration create_tasks_table

# マイグレーション実行
php artisan migrate

# キャッシュクリア
php artisan optimize:clear
```
