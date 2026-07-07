ARG PHP_EXTENSIONS="mysqli pgsql pdo_mysql pdo_pgsql"

FROM thecodingmachine/php:8.2-v4-apache-node20
WORKDIR /workspace

# Laravel sirve desde /public, no desde la raíz
ENV APACHE_DOCUMENT_ROOT=/workspace/public

COPY --chown=docker:docker . /workspace

# Instala dependencias de producción
RUN composer install --no-dev --optimize-autoloader --no-interaction


# Comandos que se ejecutan automáticamente al arrancar el contenedor
ENV STARTUP_COMMAND_1="php artisan config:cache"
ENV STARTUP_COMMAND_2="php artisan route:cache"
ENV STARTUP_COMMAND_3="php artisan migrate --force"
