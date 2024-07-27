<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Payments App

## Steps

Since its running with queue for handling race condition-like on wallet update, it's required to run queue service on different process otherwise the deposit and withdraw feature will not do anything to wallet balance. so you will need to run these commands:

```sh
npm install
npm run build
composer install
php artisan migrate --seed
php artisan queue
php artisan serve
```

if views still not working run these on any terminal:

```sh
npm run dev
```
