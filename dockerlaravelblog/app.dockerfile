FROM php:8.1-fpm

RUN apt-get update
RUN apt-get -y install unzip zip vim

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install bcmath

# Required by GD
RUN apt-get install zlib1g-dev libpng-dev --yes --quiet
# Required to use Illuminate\Http\Testing\FileFactory::image() when doing unit tests
RUN docker-php-ext-install gd
# Required by maatwebsite/excel
RUN apt-get -y install libzip-dev
RUN docker-php-ext-install zip

# Xdebug para php 8.1
RUN pecl install xdebug-3.1.4
RUN docker-php-ext-enable xdebug

# https://github.com/docker-library/php/issues/453
#RUN docker-php-ext-install openssl

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

#Se define los dos aragumentos y si no están definidos en el .env se establece su valor a 1000, q el UID del primer usuario en ubuntu
ARG UIDUser=1000
ARG GIDGroup=1000

RUN  usermod -u $UIDUser www-data && groupmod -g $GIDGroup www-data
