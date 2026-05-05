FROM php:8.5-fpm

# 必要なシステムパッケージをインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# PHP拡張をインストール
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Composerをインストール
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# アプリ起動時にマイグレーションを自動実行するエントリポイント
COPY ./docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 作業ディレクトリを設定
WORKDIR /var/www/html

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
