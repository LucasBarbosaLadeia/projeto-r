FROM php:8.1-apache

# Install dependencies and PHP extensions (mysqli, pdo_mysql)
RUN apt-get update \
    && apt-get install -y --no-install-recommends libzip-dev default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Enable apache rewrite (optional)
RUN a2enmod rewrite

WORKDIR /var/www/html
