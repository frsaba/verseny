# Instructions
## Install dependencies
PHP 8.2.11 - enable extensions `fileinfo`, `pdo_mysql`
```
composer install
yarn
```
## Configure .env
based on .env.example
```
php artisan key:generate
```
## Make database migrations
```
php artisan migrate
```
## Run
```
yarn dev
php artisan serve
```