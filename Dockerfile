# Utiliza la imagen oficial de PHP
FROM php:7.4-apache

# Copia el archivo PHP al directorio de trabajo del contenedor
COPY src /var/www/html

# Expone el puerto 80 para el servidor web Apache
EXPOSE 80
