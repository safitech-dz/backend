# Backend

## System requirements

- PHP 8.1
- MySQL database server

[XAMPP for windows](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.12/)


## Deployment steps

```bash
git clone https://github.com/Smagrinnov/laravel-backend
```

```bash
cd laravel-backend
```

```bash
composer install 
```

Create a database

```bash
cp .env.example .env
```

Set `DB_DATABASE` `DB_USERNAME` `DB_PASSWORD`

```bash
php artisan key:generate
```

```bash
php artisan optimize:clear
```

```bash
php artisan migrate:fresh --seed
```

## Topics import/export

The file `topics_directory.json` contains all the topics that were agreed on by the team. Make sure to import them on a fresh backend instance.

```bash
php artisan topics:import topics_directory.json
```

The command `php artisan topics:import` imports topics to the backend database, and applies updates if needed (It doesn't delete).

The command `php artisan topics:export` dumps a timestamped file in `storage\app\public`.

## APIs docs

Run:

```bash
php artisan scribe:generate
```

Open `api-docs\index.html` in a browser.
