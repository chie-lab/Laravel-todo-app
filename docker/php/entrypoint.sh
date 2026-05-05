#!/usr/bin/env sh
set -eu

cd /var/www/html

# Ensure Laravel writable directories exist with proper ownership.
mkdir -p \
  storage/framework/cache \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R a+rwX storage bootstrap/cache

if [ -f artisan ]; then
  max_retries="${APP_MIGRATE_MAX_RETRIES:-60}"
  retry_interval="${APP_MIGRATE_RETRY_INTERVAL:-2}"
  current=1

  echo "[entrypoint] Running database migrations..."
  while [ "$current" -le "$max_retries" ]; do
    if php artisan migrate --force; then
      echo "[entrypoint] Migrations completed."
      break
    fi

    echo "[entrypoint] Waiting for database... ($current/$max_retries)"
    current=$((current + 1))
    sleep "$retry_interval"
  done

  if [ "$current" -gt "$max_retries" ]; then
    echo "[entrypoint] Migration failed after retries." >&2
    exit 1
  fi
fi

exec php-fpm
