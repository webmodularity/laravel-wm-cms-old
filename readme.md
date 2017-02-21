# laravel-cms-skeleton

## Installation
1. Use the composer create-project command:
```php
composer create-project --prefer-dist --stability=dev --repository=https://toran.webmodularity.com/repo/private/ webmod/laravel-cms-skeleton cms
```
2. Setup DB:
    * Create a new schema (or use an existing) using utf8mb4 charset if possible
    * Make any changes needed to DB permissions and add DB credentials to `.env`
    * Run DB Migrations & Seeders:
    ```php
    php artisan migrate --seed
    ```

## Config
1. Follow the Config setup guide for the [webmodularity/laravel-auth](https://github.com/webmodularity/laravel-auth) package (including social logins if needed)
2. Setup [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) package:
    * Publish public assets:
    ```php
    php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets
    ````
    * Publish config file:
    ```php
    php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=config
    ```
    * Setup AdminLTE via the `config/adminlte.php` file.
3. Modify the `.env` file.

