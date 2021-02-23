FROM php:8.0.1-fpm

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        libpq-dev \
        ssh \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    # mysql
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    # postgres
    # && docker-php-ext-install pgsql \
    # && docker-php-ext-install pdo_pgsql \
    && docker-php-source delete


#ssh login root/root
ARG USER=root
ARG PASSWORD=root


RUN sed -i s/#PermitRootLogin.*/PermitRootLogin\ yes/ /etc/ssh/sshd_config \
    && echo "${USER}:${PASSWORD}" | chpasswd \
    && ssh-keygen -A 

RUN service ssh restart && bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data:www-data /var/www