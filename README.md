Containerize This: PHP/Apache/MySQL
===================================

### Intro

```
/php-apache-mysql/
├── apache
│   ├── Dockerfile
│   └── demo.apache.conf
├── docker-compose.yml
├── php
│   └── Dockerfile
└── public_html
    └── Login
```

Once this structure is replicated or cloned with these files, and Docker installed locally, you can simply run "docker-compose up" from the root of the project to run this entire demo, and point your browser (or curl) to http://localhost:80 to see the demo. We will get into what "docker-compose" is, and what makes up this basic demonstration in the following sections!

We'll use the following simple PHP application to demonstrate everything:

#### index.php
```
<h1>Hello Cloudreach!</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
  echo "Connected to MySQL successfully!";
}
?>
```
This code attempts to connect to a MySQL database using the mysqli interface from PHP. If successful, it prints a success. If not, it prints a failed message.

### Docker Compose


#### docker-compose.yml
```
version: "3.2"
services:
  php:
    build:
      context: './php/'
      args:
       PHP_VERSION: ${PHP_VERSION}
    networks:
      - backend
    volumes:
      - ${PROJECT_ROOT}/:/var/www/html/
    container_name: php
  apache:
    build:
      context: './apache/'
      args:
       APACHE_VERSION: ${APACHE_VERSION}
    depends_on:
      - php
      - mysql
    networks:
      - frontend
      - backend
    ports:
      - "80:80"
    volumes:
      - ${PROJECT_ROOT}/:/var/www/html/
    container_name: apache
    mysql:
      image: mysql:5.6
      restart: always
      ports:
        - "3306:3306"
      volumes:
              - data:/var/lib/mysql
      networks:
        - backend
      environment:
        MYSQL_ROOT_PASSWORD: "${DB_ROOT_PASSWORD}"
        MYSQL_DATABASE: "${DB_NAME}"
        MYSQL_USER: "${DB_USERNAME}"
        MYSQL_PASSWORD: "${DB_PASSWORD}"
      container_name: mysql
    phpmyadmin:
      image: phpmyadmin/phpmyadmin
      container_name: phpmyadmin
      environment:
       - PMA_ARBITRARY=1
      restart: always
      ports:
       - 9191:80
      volumes:
       - /sessions
      networks:
        - frontend
        - backend
networks:
  frontend:
  backend:
volumes:
    data:
```

#### apache/Dockerfile
```
FROM httpd:2.4.33-alpine

RUN apk update; \
    apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY demo.apache.conf /usr/local/apache2/conf/demo.apache.conf
RUN echo "Include /usr/local/apache2/conf/demo.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
```

#### php/Dockerfile
```
FROM php:7.2.7-fpm-alpine3.7

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli
```


#### apache/demo.apache.conf
```
ServerName localhost

LoadModule deflate_module /usr/local/apache2/modules/mod_deflate.so
LoadModule proxy_module /usr/local/apache2/modules/mod_proxy.so
LoadModule proxy_fcgi_module /usr/local/apache2/modules/mod_proxy_fcgi.so

<VirtualHost *:80>
    # Proxy .php requests to port 9000 of the php-fpm container
    ProxyPassMatch ^/(.*\.php(/.*)?)$ fcgi://php:9000/var/www/html/$1
    DocumentRoot /var/www/html/
    <Directory /var/www/html/>
        DirectoryIndex index.php
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Send apache logs to stdout and stderr
    CustomLog /proc/self/fd/1 common
    ErrorLog /proc/self/fd/2
</VirtualHost>
```
