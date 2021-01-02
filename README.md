# Install

After cloning this repo:

`cp .env.example .env`

Set values in DB_(...) variables from .env



# For dev only

```
docker exec accounting-php composer install
docker exec accounting-php php artisan key:generate
```


# For production only


```
docker exec accounting-php composer install --optimize-autoloader --no-dev
docker exec accounting-php php artisan key:generate
docker exec accounting-php php artisan config:cache
docker exec accounting-php php artisan route:cache
docker exec accounting-php php artisan view:cache
```


Done!

Access http(s)://server_domain_or_IP:8000
