# 🐳 Dockerfile Laravel optimisé pour Render
# Basé sur une image PHP officielle plus stable

FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    postgresql-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer*.json ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy application
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Nginx
COPY docker-nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/www.conf

# Laravel optimizations
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Create startup script
COPY docker-start.sh /docker-start.sh
RUN chmod +x /docker-start.sh

# Expose port
EXPOSE 80

# Start services
CMD ["/docker-start.sh"]