#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status
set -e

echo "=== SpaceIQ Studio Live Update Script ==="

# 1. Navigate to the project directory
cd /var/www/spaceiq-studio

echo "-> Discarding local database changes to prevent merge conflicts..."
git checkout database/database.sqlite

echo "-> Pulling latest changes from main branch..."
git pull origin main

echo "-> Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "-> Installing Node dependencies and building assets..."
npm install
npm run build

echo "-> Clearing old route, config, and view caches..."
php artisan view:clear
php artisan route:clear
php artisan config:clear

echo "-> Caching configuration, routes, and views for production optimization..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "-> Restoring correct folder and database permissions..."
# Ensure storage, bootstrap cache, and database folders are writable by Nginx (www-data)
chown -R www-data:www-data /var/www/spaceiq-studio/storage /var/www/spaceiq-studio/bootstrap/cache /var/www/spaceiq-studio/database
chmod -R 775 /var/www/spaceiq-studio/storage /var/www/spaceiq-studio/bootstrap/cache /var/www/spaceiq-studio/database

echo "-> Reloading PHP-FPM to invalidate OPcache..."
systemctl reload php8.3-fpm

echo "=== Deployment Completed Successfully! ==="
