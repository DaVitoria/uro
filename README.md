```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
npm install
php artisan serve
```
