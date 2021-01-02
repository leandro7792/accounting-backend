#Install

cp .env.example .env

Set values in DB_(...) variables from .env



docker exec accounting-php composer install

docker exec accounting-php php artisan key:generate



#For production only

docker exec accounting-php php artisan config:cache

docker exec accounting-php php artisan route:cache



Done!

Access http(s)://server_domain_or_IP:8000
