Test WEB & API project for Texas Company
A lot of TODOs present, due to other tasks.

FULLY(!) written by me (except jquery.js, fonts, IMGs).

If you find something not fully developed or implemented, - probably I know about this,
and could easily fix, improve, add or build that (those) things,

Please take into account - this is a TEST(!) project

-Simple Config File-
Location - config.ini

-PHP-
@todo PHP7.1
@TODO no any security layer!!!
1) save internal state - client id
2) compare request id with stored one
3) check request quantity
4) validate request params (user ids, rating marks, balance updates, etc...)
@todo tests
@todo async requests
@todo transactions
@todo cache
@todo docker file

data-generator.php - for random data generating...

Main Classes:
1) CORE\App - Simple Universal Application class
2) CORE\Web\Request - Simple Universal Web Request manager
3) CORE\Web\Response - Simple Universal Web Response manager
4) CORE\Model - Simple Model (ORM) and Model Manager @todo split...
5) APP\Controller\Web\HandlerContainer - Simple WEB requests handler (implemented instead of well-known Controller-Action pattern)
6) APP\Controller\Api\HandlerContainer - Simple API requests handler (implemented instead of well-known Controller-Action pattern)
7) APP\Model\User - Simple User Model & Manager ("user" table management)
8) APP\Model\Offer - Simple Offer Model & Manager ("offer" table management)
9) APP\Model\Professor - Simple Professor Model & Manager ("offer" table management)
10) APP\Model\Delivery - Simple Delivery Model & Manager ("delivery" table management)
11) APP\Model\Offer\Rating - Simple Offer-Rating Model & Manager ("offer_rating" table management)
12) APP\Model\Order\Offer - Simple Order-Offer Model & Manager ("order_offer" table management)
13) CORE\RDBMS - Simple Core Relation DB Manager
14) CORE\RDBMS\MySQL - Simple MySQL realization of CORE\RDBMS (in use)
15) Max SOLID
15) And other things...

-DB-
1) INNODB table type (for transaction support and for consistency)
2) Table columns types and sizes was designed for test purposes
3) Indexes and Foreign Keys present (except sorting columns - will do after main funcs becomes completed)
4) For more details - please use mysql client and observer or use something like HeidiSQL or others...

-JavaScript-
Main File:
1) pub/app.js - fully responsible for the Client application
2) App uses Browser local and session DBs
3) App uses API APP of Backend Application (api.php)
4) And more-more other things...
@todo pre-processors, minify
@todo split into separate classes (entity, storage, Offer, User, Rating, view etc.)
@todo add error handlers
@todo implement promises
@todo improve cache

-CSS-
1) pub/app.css - fully responsible for the Client look and feel
@todo pre-processors, minify
@todo split into separate files page and app styles

-Catalog-
1) This is Course Catalog simulator
2) Enter your name and balance (lets say - registration)
3) Add offers to your cart
4) Increase/Decrease your offer cart quantities
5) Make order
6) Pay (lets say - payment)

8) You could refresh page on any step(!)
9) You could use Back button - to get on previous state
10) You could use Clear button - to clear all Browser data and begin your awesome trip from zero

Dependencies (Tested on):
1) SL: PHP 5.6
2) PHP ext: json, pdo
3) PHP composer
4) MYSQL: 10.0.30-MariaDB-0+deb8u1
5) Server: Apache 2.4
6) Apache: php mod
7) OS: Debian

Usage:
1) cd /path/to/project
2) composer install

#if you aren't using dedicated web-server - you could use PHP's one
#cd pub & php -S 0.0.0.0:8080 & http://0.0.0.0:8080/web.php

3) setup PHP + dependencies
4) setup Apache virtual host + dependencies
5) setup MYSQL database & do migrations
6) enjoy

Total time spent in general: 7-8 hours.

deployed to - http://sovpalo.net/
Questions - alex.snowgirl@gmail.com


