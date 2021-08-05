FROM php:7.3-apache 

RUN apt-get update

RUN apt-get install -y libzip-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

RUN docker-php-ext-configure gd –with-gd –with-freetype-dir=/usr/include/ –with-jpeg-dir=/usr/include/ –with-png-dir=/usr/include/

RUN docker-php-ext-install gd

RUN mkdir /app

COPy . /app

WORKDIR /app

RUN chown -R www-data:www-data /app && a2enmod rewrite