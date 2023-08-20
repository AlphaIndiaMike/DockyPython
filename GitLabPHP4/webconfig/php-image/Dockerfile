# Use a more recent version of Debian
FROM debian:buster

# Install necessary packages and PHP 5.6 with mysql extension
RUN apt-get update && \
    apt-get install -y apt-transport-https lsb-release ca-certificates wget && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y php5.6 php5.6-mysql libapache2-mod-php5.6 apache2 && \
    a2enmod php5.6

# Apache config to set DocumentRoot and parse .html files as PHP
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Order Allow,Deny\n\
        Allow from All\n\
        <FilesMatch \.html$>\n\
            SetHandler application/x-httpd-php\n\
        </FilesMatch>\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
