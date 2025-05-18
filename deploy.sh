#!/bin/bash

php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
php artisan serve --host=0.0.0.0 --port=8080
