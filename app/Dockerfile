# Utiliser l'image PHP officielle avec FPM
FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    && docker-php-ext-install pdo pdo_mysql

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd mbstring zip exif pcntl bcmath opcache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement les fichiers nécessaires pour installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Copier le reste des fichiers du projet
COPY . .

# Donner les permissions au répertoire de stockage et bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Exécuter Artisan pour configurer l'application
RUN php artisan key:generate
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan route:clear

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
