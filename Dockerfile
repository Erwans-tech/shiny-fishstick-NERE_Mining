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

# Configure composer to ignore security advisories
RUN composer config --global --json policy.advisories.ignore-id '["PKSA-m5cs-t1y6-qpcs", "PKSA-3r5d-mb8f-1qw9", "PKSA-mdq4-51ck-6kdq", "PKSA-8qx3-n5y5-vvnd", "PKSA-q46n-4fdk-zjr4", "PKSA-qzrn-rnz3-85w1", "PKSA-w7xr-vk7n-rstm"]'

# Install dependencies (skip scripts because artisan doesn't exist yet)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Copy application
COPY . .

# Run composer scripts now that artisan exists
RUN composer run-script post-autoload-dump

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Nginx
COPY docker-nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/www.conf

# Create startup script
COPY docker-start.sh /docker-start.sh
RUN chmod +x /docker-start.sh

# Expose port
EXPOSE 10000

# Start services
CMD ["/docker-start.sh"]