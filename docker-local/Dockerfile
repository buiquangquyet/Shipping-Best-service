FROM registry.citigo.net/platform/php-fpm@sha256:b3ce106c6dbd41a573a34c5348b30c4ce5f26a84150206c4b041d060c7bc1c37

# Arguments defined in docker-compose.yml
ARG user=www
ARG uid=1001

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/bin/

RUN chmod +x /usr/bin/install-php-extensions && \
    install-php-extensions rdkafka mongodb-1.14.0 pdo pdo_sqlsrv sqlsrv

# Install system dependencies
#RUN apt-get update && apt-get install -y \
#    git \
#    curl \
#    libpng-dev \
#    libonig-dev \
#    libxml2-dev \
#    libzip-dev \
#    zip \
#    unzip \
#    vim \
#    nano \
#    perf
# && docker-php-ext-enable zip
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user


WORKDIR /var/www
RUN chown -R $user:$user /var/www/ \
    && chmod -R 644 /var/www/

USER $user

