# Apple-test PRODUCTION ENVIRONMENT

## Introduction
Make sure that following drivers and packages are installed:  

### 1. PHP 7.4  

### 2. Advisable extensions
 * [MBString extension](http://php.net/manual/en/mbstring.installation.php)
 * [Intl extension](http://php.net/manual/en/book.intl.php)
 * [Fileinfo extension](http://php.net/manual/en/fileinfo.installation.php)
 * [CURL](http://php.net/manual/en/book.curl.php)
 * [ZIP](http://php.net/manual/en/book.zip.php)
 * [iconv](http://php.net/manual/en/book.iconv.php)
 * [ICU]()
 * [LDAP](https://www.php.net/manual/en/book.ldap.php)
 * [FTP](https://www.php.net/manual/en/book.ftp.php)

After environment initialization and composer install you can check requirements by command 
```
php ./app/requirements.php
```
### 3. MySQL

Read more about [MySQL](https://www.mysql.com/)  

### 4. Composer

Read more about [composer](https://getcomposer.org/)

## Installation

### 1. Create MySQL (database

You will need this database params for init script  

### 2. Init Environment

In root project directory run `php init --env=Production`

Script offers you to enter required params:  

**Database params**  
* db_host - database host
* db_name - database name
* db_user - database user
* db_password - database password

You also can set params in non-interactive mode, example:
```sh
$ php init --no_interactive --env=Production --db_host=db --db_name=develop_apple_db --db_user=develop_apple_user --db_password=develop_apple_password
```

### 3. Install composer

In root project directory `app/` run
```sh
$ composer install
```

### 4. Run migrations
For non-interactive mode use --interactive=0

**For database**
```sh
php yii migrate/up --interactive=0
```

To create test admin user run `php yii user/create 'admin' 'admin'`

with params:
1 - login
2 - password


If user already exists, user will be updated 

Settings
--------

**Configure domains**

You should have two domains: domain for api and domain for admin panel

nginx site config example: 
```smartyconfig
#admin domain
server {

    charset utf-8;
    client_max_body_size 3G;

    listen 8080; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name localhost;
    root        /app/backend/web;
    index       index.php;

    location / {
        # Redirect everything that isn't a real file to index.php
        try_files $uri $uri/ /index.php$is_args$args;
    }

    # deny accessing php files for the /assets directory
    location ~ ^/assets/.*\.php$ {
        deny all;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass php:9000;
        try_files $uri =404;
    }

    location ~* /\. {
        deny all;
    }
}
```