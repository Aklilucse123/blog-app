#!/bin/sh
ech0 "Starting laravel ..."

if [! -f .env]; then
cp .env.example .env
fi

# Generate Key
php artisan key:generate --force
  
  # Run migration
php artisan migrate --force

#Storage link
php artisan storage:link || true

#clear cache
php artisan optimize:clear

#Start server
php artisan serve --host=0.0.0.0 --port=1000
