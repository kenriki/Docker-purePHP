# PHP 8.2 と Apache が入った公式イメージを使用
FROM php:8.2-apache

# 1. 必要な拡張機能（PDO, mysqli, mbstring）と Python3 のインストール
# Python3 と pip も一緒にインストールするように追加しました
RUN apt-get update && apt-get install -y \
    libonig-dev \
    python3 \
    python3-pip \
    && docker-php-ext-install pdo_mysql mysqli mbstring

# 2. Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# 3. ホスト側の php.ini をコンテナ内にコピー
COPY php.ini /usr/local/etc/php/php.ini

# 4. 作業ディレクトリの設定
WORKDIR /var/www/html