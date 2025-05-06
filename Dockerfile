FROM php:8.4-cli

# Copy dependencies
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

COPY --from=node:20.18 /usr/local /usr/local/

# Copy app
COPY ./ /app

WORKDIR /app

# Install debian dependencies
RUN apt update && apt install -y zip git libpq-dev

# Enable php pcntl to avoid pail errors 🤷
# https://dev.to/kakisoft/php-docker-how-to-enable-pcntlprocess-control-extensions-1afk
RUN docker-php-ext-install pdo_mysql pdo_pgsql
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl

# Install composer dependencies
RUN composer install --no-interaction 

# Install node dependencies
RUN npm install && npm run build

# Initialize
RUN php artisan key:generate

RUN php artisan storage:link

CMD ["composer", "run", "dev"]