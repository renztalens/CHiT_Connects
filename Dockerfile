# Use the official PHP image with Apache
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Ensure the container listens on port 8080 (required for Cloud Run)
EXPOSE 8080

# Change the Apache listening port to 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

# Set the default command to run the Apache server in the foreground
CMD ["apache2-foreground"]
