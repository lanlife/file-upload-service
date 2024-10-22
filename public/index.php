<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Database connection
$connection = getConnection();

// Initialize File model and controller
$file = new File($connection);
$fileController = new FileController($file);

// Routes
(require __DIR__ . '/../src/routes.php')($app);

$app->run();
