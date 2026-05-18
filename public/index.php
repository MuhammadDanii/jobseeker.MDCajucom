<?php
// Start the session at the very beginning of execution
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

$router = new Router();

// This executes your routes configuration file to register paths
require basePath('routes.php'); 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($uri);