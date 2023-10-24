# Instructions
## Install dependencies
PHP 8.2.11 - enable extensions `fileinfo`, `pdo_mysql`
```
composer install
yarn
```
## Configure .env
Create a .env file based on .env.example and edit the database credentials
```
php artisan key:generate
```
## Create and seed database
```
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
```
## Run
```
yarn dev
php artisan serve
```