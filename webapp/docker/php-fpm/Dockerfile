FROM php:8.3.12-fpm

RUN apt-get update && apt-get install -y ssh sshpass \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql

