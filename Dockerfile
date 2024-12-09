FROM registry.citigo.net/kship/php-base:7.3

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN mkdir bootstrap/cache \
  && chmod -R 777 bootstrap/cache \
  && composer update \
  && php artisan cache:clear

RUN composer install --optimize-autoloader