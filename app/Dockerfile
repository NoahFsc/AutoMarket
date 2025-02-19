# Utiliser l'image PHP officielle avec FPM
FROM php:8.2-fpm

# Installer les dépendances nécessaires
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
    libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd mbstring zip exif pcntl bcmath opcache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail à l'intérieur du conteneur
WORKDIR /var/www/html

# Copier seulement les fichiers nécessaires pour éviter de casser le cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances Laravel avant de copier tout le projet (optimisation du cache Docker)
RUN composer install --no-dev --optimize-autoloader

# Copier le reste du projet
COPY . .

# Donner les permissions au répertoire de stockage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Générer la clé Laravel et vider les caches
RUN php artisan key:generate && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM
CMD ["php-fpm"]
