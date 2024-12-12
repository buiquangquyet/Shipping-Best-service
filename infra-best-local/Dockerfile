FROM laradock/php-fpm:latest-8.2

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            git\
            zip\
            unzip\
            vim\
            nano\
            cron\
            supervisor\
            redis\
            libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    # Install the PHP extentions
     docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd intl redis; \
    # Install the PHP pdo_pgsql extention
    docker-php-ext-install pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd; \
    docker-php-ext-enable reids; \
    php -r 'var_dump(gd_info());' \

RUN apt-get update && apt-get install -y libz-dev

RUN apt-get update
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
