#!/bin/sh
docker-compose exec server bash -c "
php artisan cache:clear &&
php artisan config:cache &&
php artisan config:clear &&
php artisan route:clear &&
composer dump-autoload &&
php artisan clear-compiled &&
php artisan optimize &&
rm -f bootstrap/cache/config.php"
