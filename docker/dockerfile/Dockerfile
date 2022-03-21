FROM php:7.2-fpm

# FROM mysql:5.7
# COPY my.cnf /etc/mysql/conf.d/my.cnf

FROM --platform=linux/amd64 mysql:5.7

RUN cd /usr/bin && curl -s http://getcomposer.org/installer \n\
RUN apt-get update \
&& apt-get install -y \
git \
libpq-dev \
unzip \
zip \
&& docker-php-ext-install pdo_mysql pdo_pgsql mysqli 

WORKDIR /var/www/html

COPY ./app /var/www/html/

EXPOSE 3310