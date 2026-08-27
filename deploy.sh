#!/usr/bin/env bash
set -e

echo "?? Starting Space IQ Studio Deployment..."

# 1. Navigate to the project directory
PROJECT_DIR="/var/www/spaceiq_studio"
if [ ! -d "$PROJECT_DIR" ]; then
    if [ -d "/var/www/spaceiq-studio" ]; then
        PROJECT_DIR="/var/www/spaceiq-studio"
    elif [ -d "/var/www/html" ]; then
        PROJECT_DIR="/var/www/html"
    else
        PROJECT_DIR="$(pwd)"
    fi
fi

cd "$PROJECT_DIR"
echo "?? Working directory: $(pwd)"

# 2. Pull latest updates from GitHub
echo "?? Pulling latest code from GitHub (origin/main)..."
git fetch origin main
git reset --hard origin/main

# 3. Install/update Composer dependencies
if command -v composer &> /dev/null; then
    echo "?? Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
fi

# 4. Ensure storage symlink exists
echo "?? Linking storage..."
php artisan storage:link || true

# 5. Run database migrations if any
echo "??? Running migrations..."
php artisan migrate --force

# 6. Optimize and cache Laravel configs, routes, and views
echo "? Optimizing cache..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set correct web server permissions
echo "?? Updating file permissions..."
chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
if [ -f "database/database.sqlite" ]; then
    chmod 664 database/database.sqlite 2>/dev/null || true
fi

# 8. Reload PHP-FPM / Web server if running
echo "?? Reloading web services..."
if systemctl is-active --quiet nginx; then
    systemctl reload nginx 2>/dev/null || true
fi
if systemctl is-active --quiet apache2; then
    systemctl reload apache2 2>/dev/null || true
fi

PHP_FPM_SERVICE=$(systemctl list-units --type=service --state=running | grep -o 'php[0-9.]*-fpm' | head -n 1)
if [ -n "$PHP_FPM_SERVICE" ]; then
    systemctl reload "$PHP_FPM_SERVICE" 2>/dev/null || true
fi

echo "? Space IQ Studio deployed successfully!"
