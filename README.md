# SERIAL NUMBER REGISTRATION

 This is a series of php files that allows users to add and search companies and products they've purchased.

## Key files

**PHP**

* **index.php** is the main page where the user inserts company name, products and its serial numbers.
* **info.php** contains the credential for MySQL database.
* **query.php** inserts new entries.
* **modify.php** records every modification.
* **search.php** search with keyword or by date.
* **search__query.php** contains search SQL and saves to session.


**MySQL**

A DB with three tables: **hdd**, **dvr**, **orders**, and **serial\_log**.

*hdd* contains id, uid, hdd, and hdd\_serial.

*dvr* contains id, invoice, dvr\_model, dvr\_serial.

*orders* contains id, invoice, company, year month, day and time.


## Prerequisites

 It was tested on Ubuntu 16.04.3 LTS, PHP 7.0.22, Apache 2.4.18, and MySQL 14.14 Distrib 5.17.19.

**PHP7 Modules**

[PHP Modules] 

calendar
Core
ctype
date
dom
exif
fileinfo
filter
ftp
gd
gettext
hash
iconv
json
libxml
mbstring
mcrypt
mysqli
mysqlnd
openssl
pcntl
pcre
PDO
pdo_mysql
Phar
posix
readline
Reflection
session
shmop
SimpleXML
sockets
SPL
standard
sysvmsg
sysvsem
sysvshm
tokenizer
wddx
xml
xmlreader
xmlwriter
xsl
Zend OPcache
zlib

[Zend Modules]

Zend OPcache


## Installation

Copy files to root directory for web server(/var/www is default for ubuntu).

Import sn\_track.sql to empty mysql database and change info.php accordingly.

## Things to do
* Implement AJAX for nav and sql results
* Improve search with more than one categories.

## Author

Eugene Ko
