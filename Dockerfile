# 🐳 Dockerfile pour Néré Mining Laravel sur Render
# Basé sur : https://render.com/docs/deploy-php-laravel-docker

FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Copy composer files
COPY composer*.json ./

# Update composer to latest version
RUN composer self-update

# Remove lock file to force fresh resolve
RUN rm -f composer.lock

# Install dependencies with fresh resolve (ignorer alertes sécurité temporairement)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer config --global --json policy.advisories.ignore-id '["PKSA-m5cs-t1y6-qpcs", "PKSA-3r5d-mb8f-1qw9", "PKSA-mdq4-51ck-6kdq", "PKSA-8qx3-n5y5-vvnd", "PKSA-q46n-4fdk-zjr4", "PKSA-qzrn-rnz3-85w1", "PKSA-w7xr-vk7n-rstm"]'
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy codebase
COPY . .

# Laravel setup
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R nginx:nginx /var/www/html && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 {} \;