## Overview

This project is to fetch and manipulate JSON data from a fictional social network REST API. It doesn't use any common framework and everything has been developed with pure PHP.

### Project Skeleton

The structure of the directories is as follow:

* **config directory** contains service factories
* **core directory** containse the application abstractions and the base classes
* **data directory** contains database structure and its data
* **public directory** contains the public files that are visible to the web server
* **src** contains controllers, services and repositories of the application

### Dependencies and packages

The projects requires **PHP 7.4** and uses two main packages one for making queries to the database and another one for sending HTTP requests to call the APIs. Here are the packages:

```php
"doctrine/dbal": "3.0.0",
"symfony/dotenv": "^5.2",
"guzzlehttp/guzzle": "^7.3"
```

### Installation

To install the application first clone the project and change to the directory. 

```bash
git clone https://github.com/hamidgh83/simple-api.git
```

**create a database**, import the schema and add the connection information in **.env** file. Then install the package using composer.

```bash
composer install
```

### Running the application

After finishing installation, you can change directory to the project toot and run it with php built-in web server:

```bash
php -S localhost:8080 -t public/
```

The application provides two APIs as follow:

1. Fetch data from supermetrics API and store into database

```php
GET  http://localhost:8080/fetch
```

2. Get stats calculated from stored data

```php
GET http://localhost:8080/stats
```

**NOTE:** *Make sure that you call the the above endpoints sequentially.*