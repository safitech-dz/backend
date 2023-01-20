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

## APIs docs

Run:

```bash
php artisan scribe:generate
```

Open `api-docs\index.html` in a browser.
