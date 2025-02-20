# Utiliser l'image officielle PHP avec FPM
FROM php:8.2-fpm

# Installer les dépendances système et nettoyer le cache pour optimiser la taille de l'image
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier seulement les fichiers nécessaires pour installer les dépendances
COPY composer.json composer.lock ./

# Installer les dépendances avec Composer
RUN composer install --no-dev --optimize-autoloader

# Copier le reste du projet avec les bonnes permissions
COPY --chown=www-data:www-data . .

# Corriger les permissions des dossiers nécessaires
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM
CMD ["php-fpm"]
