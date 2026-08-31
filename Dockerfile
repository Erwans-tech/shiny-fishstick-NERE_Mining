# Build stage
FROM php:8.3-fpm-alpine as builder

# Install system dependencies
RUN apk add --no-cache \
    build-base \
    libzip-dev \
    oniguruma-dev \
    curl \
    git

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    zip \
    pdo \
    pdo_mysql \
    opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --no-interaction --prefer-dist

# Copy application code
COPY . .

# Generate app key if not exists
RUN php artisan key:generate || true

# Production stage
FROM php:8.3-fpm-alpine

# Install runtime dependencies
RUN apk add --no-cache \
    libzip \
    oniguruma \
    nginx \
    supervisor \
    curl

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    zip \
    pdo \
    pdo_mysql \
    opcache

# Copy PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Copy nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf

# Copy supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

# Copy application from builder
COPY --from=builder /app .

# Create necessary directories
RUN mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap \
    && chmod -R 775 storage bootstrap

# Expose port
EXPOSE 80

# Start services
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
