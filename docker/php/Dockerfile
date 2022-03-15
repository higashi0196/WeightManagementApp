FROM php:7.2-fpm

COPY index.php /

RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mysqli 

WORKDIR /var/www/html

COPY ./app /var/www/html/