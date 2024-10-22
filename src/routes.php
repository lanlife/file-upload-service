<?php

use Slim\App;

return function (App $app) {
    $app->post('/file', [FileController::class, 'store']);
    $app->get('/file/{id}', [FileController::class, 'get']);
};
