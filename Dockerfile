FROM php:8.4-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=prod \
    APP_DEBUG=0

RUN apk add --no-cache \
    bash git unzip curl libzip-dev oniguruma-dev icu-dev zlib-dev \
    autoconf gcc g++ make libxml2-dev mysql-client npm

RUN docker-php-ext-install pdo pdo_mysql intl mbstring zip xml

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier tout le projet AVANT composer install
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

