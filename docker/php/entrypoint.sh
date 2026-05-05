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
  echo "[entrypoint] Running database migrations..."
  php artisan migrate --force
  echo "[entrypoint] Migrations completed."
fi

exec php-fpm
