# Étape 1 : image PHP officielle avec extensions nécessaires
FROM php:8.2-fpm-alpine

# Variables d'environnement
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=prod \
    APP_DEBUG=0 \
    SYMFONY_ALLOW_APP_DEV=0

# Installer les dépendances système nécessaires
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    curl \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    zlib-dev \
    autoconf \
    gcc \
    g++ \
    make \
    libxml2-dev \
    mysql-client \
    npm

# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql intl mbstring zip xml

# Installer Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier uniquement les fichiers nécessaires pour installer les dépendances
COPY composer.json composer.lock ./

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copier tout le projet
COPY . .

# Générer le cache pour la prod
RUN php bin/console cache:clear --env=prod

# Exposer le port 8000
EXPOSE 8000

# Commande par défaut pour démarrer Symfony
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
