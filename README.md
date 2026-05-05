# Laravel-todo-app

Docker Compose で Laravel + Nginx + MySQL を起動するための最小手順です。

## 前提

- Docker / Docker Compose が利用可能であること
- 作業ディレクトリがこのリポジトリ直下であること

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
