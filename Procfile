web: vendor/bin/heroku-php-nginx -C heroku/nginx.conf /public
worker: php artisan queue:listen --tries=10 --delay=20 --memory=64 --sleep=0
