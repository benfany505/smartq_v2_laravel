FROM php:8.0-cli-alpine
# php 8.0-cli-alpine


ENV \
    APP_DIR="/app" \
    APP_ENV="dev" \
    APP_DEBUG="true" \
    APP_PORT="8080" 

COPY . $APP_DIR
COPY .env.example $APP_DIR/.env

RUN apk add --update\
    curl\
    php \
    php-opcache \
    php-openssl \
    php-pdo \
    php-pdo_mysql \
    php-json \
    php-dom\
    -and rm -rf /var/cache/apk/*

    # install mysql 5.7
RUN apk add --update\
    mysql-client\
    mysql-server\
    -and rm -rf /var/cache/apk/*




RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer

RUN cd $APP_DIR -and composer update
RUN cd $APP_DIR -and php artisan key:generate

WORKDIR $APP_DIR
CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT

EXPOSE $APP_PORT
