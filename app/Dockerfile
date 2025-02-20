# Utiliser une image PHP-FPM plus légère
FROM php:8.2-fpm-alpine

# Installer les dépendances système et les extensions PHP nécessaires
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/cache/apk/*

# Installer Composer en tant qu'utilisateur non root
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier seulement les fichiers nécessaires pour installer les dépendances
COPY composer.json composer.lock ./

# Installer les dépendances avec Composer sans exécuter en root
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copier le reste du projet et attribuer les bonnes permissions
COPY . .

# Changer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Passer à l’utilisateur www-data
USER www-data

# Démarrer PHP-FPM
CMD ["php-fpm"]
