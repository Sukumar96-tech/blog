# Use official PHP image
FROM php:8.1-fpm

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libmcrypt-dev \
    mysql-client \
    libmagickwand-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    && docker-php-ext-enable pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copy application files
COPY . .

# Copy environment file
RUN cp .env.example .env || true

# Generate application key
RUN php artisan key:generate --force || true

# Create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs public/storage && \
    chmod -R 775 storage bootstrap/cache

# Create symbolic link for storage
RUN php artisan storage:link || true

# Expose port
EXPOSE 8000

# Start PHP-FPM
CMD ["php-fpm"]
