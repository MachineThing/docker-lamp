FROM php:8.1.0-apache-bullseye

RUN apt-get update
RUN apt-get upgrade -y

# Install PHP modules
RUN docker-php-ext-install pdo_mysql

# Enable apache modules
RUN a2enmod rewrite headers
