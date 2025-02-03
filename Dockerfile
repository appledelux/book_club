# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Configurar la zona horaria
RUN echo "Europe/Madrid" > /etc/timezone

# Copia la configuración personalizada de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copia el código fuente de la aplicación
COPY src/ /var/www/html

# Habilita el módulo de reescritura (opcional)
RUN a2enmod rewrite

# Configura permisos
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80
EXPOSE 80