FROM php:8.5-apache

# Install native system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install modern MySQL and zip drivers
RUN docker-php-ext-install pdo pdo_mysql zip

# Enable URL rewrite rules (essential for modern routing/frameworks)
RUN a2enmod rewrite

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Inject Composer package manager
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
