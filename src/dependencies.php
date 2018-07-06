<?php
// DIC configuration

use App\Utils\Snakize;
use App\Components\Validation\Rules;

$container = $app->getContainer();

$container['view'] = function ($c) {
    return new \Slim\Views\PhpRenderer($c['settings']['views']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c['settings']['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// crypt module
$container['crypt'] = function ($c) {
    return new \App\Utils\Crypto($c['settings']['salt']);
};

// jwt module
$container['jwt'] = function ($c) {
    return new \App\Utils\JWTWrapper($c['settings']['jwt']['key']);
};

$container["validation_rules"] = function ($c) {
    /**
     * Return the validation rules associated to the method of the controller.
     *
     * @param string $class
     * @param string $method
     * @return array
     */
    return function ($controller, $action) use ($c): array {
        $settings = $c["settings"];

        $decamelizedController = explode('\\', $controller);
        $controller = Snakize::transform(array_pop($decamelizedController));
        $action     = Snakize::transform($action);

        /** @var DirectoryIterator $fileInfo */
        foreach (new DirectoryIterator($settings["validation_rules_directory"]) as $fileInfo) {
            if (!is_dir($fileInfo->getRealPath())) {
                $name = explode(".", pathinfo($fileInfo->getRealPath())["filename"]);
                if ($controller === $name[0] && $action === $name[1])
                    return include $fileInfo->getRealPath();
            }
        }

        return null;
    };
};