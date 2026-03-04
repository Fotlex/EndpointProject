FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    librabbitmq-dev \
    libzip-dev \
    unzip \
    git \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html