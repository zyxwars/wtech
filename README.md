## Requirements

-   https://github.com/kurice/wtech25
-   https://github.com/kurice/wtech25/blob/main/semestralny-projekt/README.md

## Development

### Setup

Install php, composer and laravel
https://laravel.com/docs/12.x/installation#installing-php

Install node version from <strong>.nvmrc</strong>, a version manager is recommended
https://nodejs.org/en/download

Install dependencies

```
composer install

npm install
```

Create <strong>.env</strong>, use <strong>.env.example</strong> as a guide

Generate APP_KEY in <strong>.env</strong>

```
php artisan key:generate
```

Run database migrations

```
php artisan migrate
```

### Running

```
composer run dev
```
