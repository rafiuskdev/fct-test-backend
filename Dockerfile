FROM php:8.2-fpm-bookworm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    wget \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www
COPY --chown=www:www . /var/www

USER www

EXPOSE 9000

CMD ["sh", "-c", "composer install && php-fpm"]
