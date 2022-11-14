FROM php:8.1-fpm
COPY . /var/www
WORKDIR /var/www
RUN rm -rf /var/www/html \
&& apt-get update -y \
&& apt-get install -y \
autoconf \
build-essential \
curl \
git \
libicu-dev \
libmpdec-dev \
libpq-dev \
libzip-dev \
unzip \
zlib1g-dev \
&& apt autoremove -y \
&& apt clean \
&& pecl install redis \
&& docker-php-ext-install \
bcmath \
intl \
opcache \
pdo_mysql \
pdo_pgsql \
pgsql \
zip \
&& curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/commposer
CMD ["/usr/local/sbin/php-fpm"]
EXPOSE 9000