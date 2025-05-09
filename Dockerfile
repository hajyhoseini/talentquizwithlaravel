# استفاده از PHP با اکستنشن‌ها
FROM php:8.2-fpm

# نصب وابستگی‌ها
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# نصب Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تنظیم دایرکتوری پروژه
WORKDIR /var/www

# کپی کل پروژه
COPY . .

# نصب پکیج‌های Composer
RUN composer install --optimize-autoloader --no-dev

# تنظیم دسترسی
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# تنظیم پورت و دستور اجرا
EXPOSE 8000
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
