<?php
return [
    'settings' => [
        'displayErrorDetails'       => true,    // set to false in production
        'addContentLengthHeader'    => false,   // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        // Views path
        'views' => __DIR__.'/../templates',

        // Routes settings
        'routes' => [
            'v1' => [
                "*************INSERT THE BASE ROUTES*************"
            ],
        ],

        // Database settings
        'db' => [
            'driver'    => 'mysql',
            'host'      => '*************INSERT THE IP*************',
            'port'      => '*************INSERT THE PORT*************',
            'database'  => '*************INSERT THE SCHEMA*************',
            'username'  => '*************INSERT THE USERNAME*************',
            'password'  => '*************INSERT THE PASSWORD*************',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // Monolog settings
        'logger' => [
            'name'  => 'afRICS-app',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'jwt' => [
            'key' => '*************INSERT A JWT KEY*************',
        ],

        'salt' => '*************INSERT A SALT*************',

        'validation_rules_directory' => __DIR__ . "/rules",

        'upload_directory'          => __DIR__.'/../upload',

        'install_key'               => "*************INSERT AN INSTALL KEY*************",
    ],
];
