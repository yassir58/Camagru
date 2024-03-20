FROM debian:latest

RUN apt update -y
RUN apt upgrade -y
RUN apt install nginx openssl curl -y
COPY ./nginx-default.conf /etc/nginx/sites-enabled/default
RUN apt-get install php-fpm php-mysql php-json composer -y
WORKDIR /var/www/html/app
RUN mkdir uploads
RUN mkdir -p /var/www/html/app/uploads && \
    chown -R www-data:www-data /var/www/html/app/uploads && \
    chmod -R 755 /var/www/html/app/uploads
RUN composer require firebase/php-jwt vlucas/phpdotenv
RUN service php8.2-fpm restart
RUN echo "<?php phpinfo(); ?>" >> /var/www/html/info.php
ADD ./app /var/www/html/app
ADD .env /var/www/html/app/.env

CMD service php8.2-fpm start && nginx -g 'daemon off;'