FROM yiisoftware/yii2-php:7.4-fpm

COPY docker/php/base.ini /usr/local/etc/php/conf.d/base.ini

ARG DB_NAME
ARG DB_USER
ARG DB_PASSWORD

COPY app /app

WORKDIR /app
RUN composer install

RUN php init --no_interactive --overwrite --env=Development --db_name=$DB_NAME --db_user=$DB_USER --db_password=$DB_PASSWORD