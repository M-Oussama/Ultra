

## About Rozaric starter :

This is a starter template for our projects.

- Laravel 8
- metronic dashboard
- Porto frontend
- barryvdh / laravel-ide-helper
- Maatwebsite / Laravel-Excel
- niklasravnsborg / laravel-pdf
- spatie / laravel-permissions
- spatie / laravel-backup
- spatie / media-library

## To run this in dev :
- have a working mysql database
- run the following commands :
- npm install //install node-modules
- npm run dev //compile node-modules
- composer install //install composer packages
- composer dump-autoload //discover composer packages
- make .env file from .env.example and configure it //configure your environment
- php artisan key:generate //make a key for your laravel app
- php artisan storage:link //make a symlink to storage
- php artisan migrate --seed //create database tables and populate them with the seed files
- php artisan serv //to run your dev server


- php artisan migrate
- php artisan db:seed --class=EmployeeSeeder
// 13/07/2023
- php artisan migrate
- php artisan db:seed --class=SalesSeeder
- php artisan db:seed --class=StockSeeder
- add column for product called stock_id

