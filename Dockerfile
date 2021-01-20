FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# compression
RUN apt-get update \
        && apt-get install -y \
        libbz2-dev \
        zlib1g-dev \
        libzip-dev \
        && docker-php-ext-install -j$(nproc) \
                zip \
                bz2

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=$user:$user . /var/www

# Set working directory
WORKDIR /var/www

# Change current user
USER $user

# Expose port 9000 and start php-fpm server
EXPOSE 9000
