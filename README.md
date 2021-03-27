## Overview

This project is a simpe API to fetch and manipulate JSON data from a fictional social network REST API. It doesn't use any common framework and everything has been developed with pure PHP.

### Project Skeleton

The structure of the directories is as follow:

* **config directory** contains service factories
* **core directory** containse the application abstractions and the base classes
* **data directory** contains database structure and its data
* **public directory** contains the public files that are visible to the web server
* **src** contains controllers, services and repositories of the application

### Installation

To install the application first clone the project and change to the directory. 

```bash
git clone https://github.com/hamidgh83/simple-api.git
```

**create a database**, import the data and add the connection information in **.env** file. Then install the package using composer.

```bash
composer install
```

### How to call APIs

The application provides two endpoints:

1. Register a user with a short-live token
   
        POST  http://localhost/assignment/register

2. Get a list of posts by a user

        GET http://localhost/assignment/posts