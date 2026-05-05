# Laravel-todo-app

Docker Compose で Laravel + Nginx + MySQL を起動するための最小手順です。

## 前提

- Docker / Docker Compose が利用可能であること
- 作業ディレクトリがこのリポジトリ直下であること

## 初回セットアップ

1. コンテナをビルドして起動

```bash
docker compose up -d --build
```

2. Laravel プロジェクト未作成（`src/artisan` がない）場合のみ、プロジェクトを作成

Linux / macOS:

```bash
docker compose exec --user "$(id -u):$(id -g)" app composer create-project laravel/laravel . --prefer-dist
```

Windows (PowerShell):

```powershell
docker compose exec --user "1000:1000" app composer create-project laravel/laravel . --prefer-dist
```

3. 環境変数ファイルを作成

```bash
cp src/.env.example src/.env
```

4. Laravel の APP_KEY を生成

```bash
docker compose exec app php artisan key:generate
```

## 起動手順

1. コンテナをビルドして起動

```bash
docker compose up -d --build
```

2. 起動状態を確認

```bash
docker compose ps
```

3. アプリにアクセス

- Web: http://localhost:8080
- phpMyAdmin: http://localhost:8081

## 停止手順

```bash
docker compose down
```

## データを含めて初期化したい場合

MySQL ボリュームも削除して完全に作り直す場合:

```bash
docker compose down -v
docker compose up -d --build
```

## 動作確認

HTTP ステータス確認:

```bash
curl -s -o /dev/null -w "%{http_code}\n" http://localhost:8080
```

## 補足

- 起動直後は DB の準備タイミングにより一時的に 502 になることがあります。
- `docker compose exec app composer ...` を `--user "$(id -u):$(id -g)"` なしで実行すると、`src` 配下が root 所有になって編集できなくなる場合があります。
