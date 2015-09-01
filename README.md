# Silverstripe App Template - (c) Andre Lohmann (and others) 2015

## Maintainer Contact 
 * Andre Lohmann
   <lohmann.andre (at) gmail (dot) com>
	
## Requirements

Silverstripe 3.2.x

## Overview
roof-for-refugees.org is a webapplication to help good hearted people finding homeless refugees to offer them a roof until their situation is clearyfied.

## Installation

 * Clone Project
 * run 'composer install' (see https://getcomposer.org/)
 * copy _ss_environment_default.php to _ss_environment.php
 * set database configuration and other config parameters within _ss_environment.php
 * copy htaccess_default to .htaccess
 * set parameters on .htaccess (RewriteBase) as needed
 * create directory "silverstripe-cache"
 * chmod 777 -R assets/ silverstripe-cache/
 * create apache vHost like in the following example
 * /dev/build the system (see http://www.silverstripe.org/)

#### Ubuntu Packages

In Ubuntu 14.04 install the following Packages

```
apt-get install libapache2-mod-php5 php5-cli php5-curl php5-gd php5-imagick php5-mcrypt php5-tidy php5-xcache php5-geoip geoip-bin php5-mysql mysql-server-5.6 mysql-client-5.6 mysql-server-core-5.6 mysql-client-core-5.6 php5-redis redis-server phpmyadmin libfaac0 libfaac-dev libx264-dev libx264-142 x264 libav-tools mcrypt
```
Activate rewrite and mcrypt modules

```
php5enmod mcrypt
a2enmod rewrite
service apache2 restart
```

#### Apache vHost Example:

```
<VirtualHost *:80>
    ServerName YOURDOMAIN
    ErrorLog /var/log/apache2/error-YOURPROJECT
    LogLevel notice
    RedirectMatch permanent ^/(.*) http://www.YOURDOMAIN/$1
</VirtualHost>

<VirtualHost *:80>
    ServerName www.YOURDOMAIN
    ServerAlias YOURDOMAINALIAS
    DocumentRoot /var/www/YOURPROJECT/

    ServerAdmin ADMINEMAIL

    # Logfiles:
    CustomLog /var/log/apache2/YOURPROJECT combined
    ErrorLog /var/log/apache2/error-YOURPROJECT
    LogLevel warn

    <Directory "/var/www/YOURPROJECT/">
            Options FollowSymLinks
            AllowOverride All
            Require all granted                                                                                                                                                                    
    </Directory>                                                                                                                                                                                

    DirectoryIndex index.php index.html

    # PHP Flags
    php_admin_flag engine on
    php_admin_flag short_open_tag on
    #use only <?php

    php_admin_flag safe_mode off
    php_admin_flag register_globals off
    php_admin_flag allow_url_fopen on
    php_admin_flag allow_url_include off
    php_admin_flag display_errors off
    php_admin_flag display_startup_errors off
    #php_value error_reporting 2039

    #php_admin_value open_basedir "/var/www/YOURPROJECT/:/tmp"
    php_admin_value memory_limit 512M
    php_admin_value date.timezone "Europe/Berlin"
</VirtualHost>
```