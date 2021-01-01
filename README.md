#Install

cp .env.example .env

Set values in DB_(...) variables from .env



docker-compose exec accounting-php composer install

docker-compose exec accounting-php php artisan key:generate



Done!

Access http(s)://server_domain_or_IP:8000
