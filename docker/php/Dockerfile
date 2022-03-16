FROM php:7.2-fpm

# RUN cd /usr/bin && curl -s http://getcomposer.org/installer \n\
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mysqli 

WORKDIR /var/www/html

COPY index.php /
COPY ./app /var/www/html/