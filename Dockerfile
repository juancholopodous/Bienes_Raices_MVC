FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip git curl
RUN docker-php-ext-install pdo pdo_mysql mysqli gd zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80