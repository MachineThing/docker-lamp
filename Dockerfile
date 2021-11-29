FROM php:8-apache-bullseye

RUN apt-get update
RUN apt-get upgrade -y

# Enable apache modules
RUN a2enmod rewrite headers
