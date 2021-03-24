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

Then **create a database** and add the connection information in **.env** file. Install the package using composer.

```bash
composer install
```

