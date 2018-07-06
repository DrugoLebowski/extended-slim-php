<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Instantiate RedBeanORM
if (!empty($settings["db"]) && !is_null($settings["db"])) {
    $cdb = $settings["db"];
    \RedBeanPHP\R::setup(
        "{$cdb["driver"]}:host={$cdb["host"]}:{$cdb["port"]};database={$cdb["database"]}",
        $cdb["username"],
        $cdb["password"]
    );
}

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
try {
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
