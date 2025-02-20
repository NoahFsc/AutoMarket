# Utiliser une image PHP-FPM plus légère
FROM php:8.2-fpm-alpine

# Installer les dépendances système et les extensions PHP nécessaires
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    npm \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/cache/apk/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Assurer les bonnes permissions en tant que root
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 755 /var/www/ \
    && chmod -R 775 /var/www/html \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ugo+rw storage bootstrap/cache \
    && chown -R 1000:1000 /var/www/html \
    && chmod -R 755 /var/www/html \
    && chown -R $USER:www-data storage bootstrap/cache

# Installer les dépendances avec Composer
RUN composer install
RUN npm install

# Passer à l’utilisateur www-data
#USER www-data

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]
