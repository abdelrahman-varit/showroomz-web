# Dockerfile
FROM php:7.2-fpm

LABEL maintainer="mwfayez@gmail.com"
LABEL service="showroomz"

# Set working directory
WORKDIR /var/www/html

# Install dependencies && extensions
RUN apt-get -qq update && apt-get -qq install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    curl  > /dev/null \
    && docker-php-ext-configure intl > /dev/null \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl intl > /dev/null \
    && docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ > /dev/null \
    && docker-php-ext-install gd > /dev/null \
    && apt-get -qq clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install redis
RUN curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/5.2.2.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv phpredis-* /usr/src/php/ext/redis \
    && docker-php-ext-install redis > /dev/null \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Change current user to www
USER www
