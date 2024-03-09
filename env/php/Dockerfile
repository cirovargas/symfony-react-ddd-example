FROM php:8.2-alpine

WORKDIR /app

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

RUN apk update && apk add --no-cache \
      supervisor \
      zip \
      wget \
      curl \
      unzip \
      git \
      bash \
    && install-php-extensions \
      amqp \
      swoole \
      pdo_pgsql \
      zip \
      sockets \
      @composer \
    && rm -rf /var/cache/apk/*

RUN printf '#!/bin/bash\nphp bin/console "$@"' > /usr/bin/sf && \
    chmod +x /usr/bin/sf

CMD /usr/bin/supervisord -n -c /etc/supervisord.conf
