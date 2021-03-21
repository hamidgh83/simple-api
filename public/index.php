<?php

// TODO Load project environment from .env file 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use Core\Application\Application;
use Core\Exception\ConfigurationException;
use Core\Http\Request;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Everything is relative to the application root now.
 */
chdir(dirname(__DIR__));

if (is_readable('.env')) {
    $dotenv = new Dotenv();
    $dotenv->load('.env');
} else {
    throw new ConfigurationException();
}

$request = new Request;
$app     = new Application($request);

$app->run();
