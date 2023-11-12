# Use the PHP image with Nginx compatibile with CodeIgniter 3 and PHPUnit
FROM webdevops/php-nginx:7.3-alpine

# Set your working directory
WORKDIR /app

# Copy the CodeIgniter code into the container's web root
COPY . /app

# Use Composer to install PHPUnit 7
RUN composer require --dev phpunit/phpunit ^7

# Expose port 80 for the Nginx server
EXPOSE 80

# No need for a custom start command; the base image handles it