# Dockerfile
FROM php:7.2-fpm

LABEL maintainer="mwfayez@gmail.com"
LABEL service="showroomz"

RUN apt-get -q update && apt-get -q install -y --no-install-recommends \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libicu-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure intl > /dev/null \
    && docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir > /dev/null \
    && docker-php-ext-install intl pdo pdo_mysql mbstring zip gd > /dev/null \
    && apt-get -q clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && export TERM=xterm

RUN curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/5.2.2.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv phpredis-* /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && rm -rf  /tmp/* /var/tmp/* /usr/share/doc/*

