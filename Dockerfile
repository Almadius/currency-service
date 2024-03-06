FROM php:8.2-fpm

# Установка необходимых расширений
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Получение Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
