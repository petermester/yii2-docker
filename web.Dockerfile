ARG PHP_IMAGE

FROM $PHP_IMAGE

ARG PHP_IMAGE
ARG MYSQL_IMAGE
ARG PHP_GD_INSTALL
ARG PHP_ZIP_INSTALL

# Install mc, wget, npm
RUN apt-get update && apt-get install -y \
    locales \
    locales-all \
    mc \
    wget \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libicu-dev \
    libpng-dev \
    libzip-dev \
    zip \
    git \
    lnav

# Enable mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-configure intl

# Before PHP 7.3
# RUN docker-php-ext-configure zip --with-libzip
RUN $PHP_ZIP_INSTALL

# Before PHP 7.4
# RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
# From PHP 7.4
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN $PHP_GD_INSTALL

RUN docker-php-ext-install mysqli pdo pdo_mysql intl gd zip

# Setup php ini files
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

ARG PHP_IMAGE
ARG MYSQL_IMAGE

ENV PHP_IMAGE=$PHP_IMAGE
ENV MYSQL_IMAGE=$MYSQL_IMAGE

WORKDIR /var/www/html