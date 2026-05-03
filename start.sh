#!/bin/sh

echo "Starting Laravel..."

# Create .env if not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate key
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Storage link
php artisan storage:link || true

# Clear cache
php artisan optimize:clear

# Start server
php artisan serve --host=0.0.0.0 --port=10000