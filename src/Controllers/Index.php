<?php

namespace App\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class Index
{

    public function test(Request $request, Response $response, array $args)
    {
        $parameters = array_merge(
            $request->getParams() ?? [],
            $args
        );

        return $response->withJson([
            "parameters" => $parameters,
        ]);
    }

}