FROM php:7.4-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  zip \
  npm \
  libmemcached-dev \
  libmemcached-tools \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

# php-memcached
RUN set -ex \
    && rm -rf /var/lib/apt/lists/* \
    && MEMCACHED="`mktemp -d`" \
    && curl -skL https://github.com/php-memcached-dev/php-memcached/archive/master.tar.gz | tar zxf - --strip-components 1 -C $MEMCACHED \
    && docker-php-ext-configure $MEMCACHED \
    && docker-php-ext-install $MEMCACHED \
    && rm -rf $MEMCACHED

RUN pecl install redis-5.1.1 \
  && pecl install xdebug-2.8.1 \
  && docker-php-ext-enable redis xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "file_uploads=On\n" \
         "memory_limit=64M\n" \
         "upload_max_filesize=64M\n" \
         "post_max_size=64M\n" \
         "max_execution_time=600\n" \
         > /usr/local/etc/php/conf.d/uploads.ini

RUN apt-get install git -y

WORKDIR /var/www

COPY . ./

RUN npm install --global yarn

CMD [ "php", "artisan", "serv", "--host=0.0.0.0" ]
