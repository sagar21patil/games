Containerize This: PHP/Apache/MySQL
===================================

### Intro

You can install application installation using one step from below two.

STEP #1:

1) I believe you have downloaded code from Github.
2) Install docker in your computer.
3) You can simply run  "docker-compose up" or "docker-compose up -d" (PHP,Apache,MySQL and phpmyadmin setup)
4) If step 3 done(Application installation) then point your browser to below path.
http://localhost/sportradar/index.php

4) Mysql database
URL: http://localhost:9191/
  Server:mysql
  user:root
  password:root


STEP #2:

1) I believe you have downloaded code from Github.
2) Install LAMP, XAMP and phpmyadmin in your computer.
3) Put downloaded code inside XAMP or LAMP httdocs folder
4) Import sportradar database (take from Path:sportradar/Document/DB/sportradar.sql)
5) Change DB credentials in config file. path:sportradar/public_html/sportradar/api/config/config.php
5) Then point your browser to http://localhost/sportradar/index.php
4) Mysql database
   URL: http://localhost/phpmyadmin
