FROM richarvey/nginx-php-fpm:3.1.6

# Copy application
COPY . /var/www/html

# Container / PHP / Nginx config
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# Laravel production defaults
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN php artisan key:generate --force || true
RUN php artisan migrate --force || true
RUN php artisan config:clear || true
RUN php artisan route:clear || true

CMD ["/start.sh"]
