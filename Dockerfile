FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    sqlite3 libsqlite3-dev \
    libonig-dev libxml2-dev \
    build-essential

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Make start script executable
RUN chmod +x start.sh

EXPOSE 10000

# Start app
CMD ["sh", "start.sh"]