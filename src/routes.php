<?php

// Vendor
use Slim\Http\Request;
use Slim\Http\Response;

// Internal
use App\Middlewares\Authentication;


$routes = $app->getContainer()->get("settings")["routes"];

$app->post(
    "/",
    \App\Controllers\Index::class . ":test"
);