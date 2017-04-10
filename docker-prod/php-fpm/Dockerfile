FROM phpdockerio/php70-fpm:latest

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.0-memcached php7.0-mysql php7.0-bcmath php7.0-mbstring php7.0-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


WORKDIR "/var/www/quest-bot"