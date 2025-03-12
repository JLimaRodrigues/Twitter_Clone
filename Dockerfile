FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libzip-dev \
        default-mysql-client \
        mariadb-client && \
    docker-php-ext-install pdo pdo_mysql zip gd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY twitter_clone /var/www/html/twitter_clone

WORKDIR /var/www/html/twitter_clone

RUN chown -R www-data:www-data /var/www/html/twitter_clone/public && \
    chmod -R 755 /var/www/html/twitter_clone/public

RUN chown -R www-data:www-data /var/www/html/twitter_clone/var/cache && \
    chmod -R 775 /var/www/html/twitter_clone/var/cache && \
    chown -R www-data:www-data /var/www/html/twitter_clone/var/log && \
    chmod -R 775 /var/www/html/twitter_clone/var/log

COPY docker/twitter_clone.conf /etc/apache2/sites-available/twitter_clone.conf

RUN a2ensite twitter_clone.conf

COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh
CMD /usr/local/bin/wait-for-it.sh db:3306 --timeout=60 -- php bin/console doctrine:migrations:migrate --no-interaction

EXPOSE 80
