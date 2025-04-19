# Use the official PHP image
FROM php:8.0-cli

# Set the working directory
WORKDIR /var/www/html

# Copy your application files into the container
COPY . /var/www/html

# Expose the port the app will run on
EXPOSE 10000

# Command to start the PHP server
CMD ["php", "-S", "0.0.0.0:10000"]