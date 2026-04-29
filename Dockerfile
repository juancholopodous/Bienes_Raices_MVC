# Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    gnupg

# Instalar Node.js (necesario para ejecutar Gulp/npm)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Instalar extensiones de PHP necesarias para MySQL
RUN docker-php-ext-install pdo pdo_mysql gd zip

# Instalar Composer desde su imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el DocumentRoot de Apache para que apunte a tu carpeta /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite (vital para MVC y rutas amigables)
RUN a2enmod rewrite

# Copiar el código fuente a la carpeta del servidor
COPY . /var/www/html

# Instalar dependencias de PHP y Node.js
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Ajustar permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80