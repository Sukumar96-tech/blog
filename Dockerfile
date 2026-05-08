FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Configure Apache public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Clear Laravel caches
RUN php artisan optimize:clear

# Create required Laravel folders
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/cache \
    storage/framework/views \
    bootstrap/cache

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Create storage link
RUN php artisan storage:link || true

# Expose Apache port
EXPOSE 80

# Start Laravel app
CMD php artisan migrate --force && php artisan db:seed --force && apache2-foreground