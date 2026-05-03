From php:8.2-cli

# Install dependecies
Run apt-get update && apt-get install -y \
git unzip curl zip \
sqlite3 libsqlite3-dev
libonig-dev libxml2-dev \
build-essential
# Install Php extensions
Run docker-php-ext-install pdo pdo_sqlite mbstring bcmath

#Install Composer

Copy --from=composer:latest/usr/bin/composer /usr/bin/composer
 WORKDIR /var/www
 COPY  ..
 # Install laravel depencies
 Run composer install --no-dev --optimize-autoloader

 # Permissions
 RUN chmod -R 775 storage bootstrap/cache
 #make start script exectuble
 RUN chmod +x start.sh
 EXPOSE 1000

 #start app
 CMD [ "sh", "start.sh" ]
