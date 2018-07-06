<?php

namespace App\Middlewares;

use App\Utils\Tables;
use Closure;
use RedBeanPHP\R;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use DusanKasan\Knapsack\Collection;

/**
 * Middleware used to authenticate the JWT token.
 *
 * Class Authentication
 * @package App\Middleware
 */
class Authentication
{

    /** @var ContainerInterface */
    private $container;

    /**
     * Authentication constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->container = $app->getContainer();
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param Closure $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $authorization = $request->getHeaderLine("Authorization");

        // For the other routes - if the token is empty, then the execution
        // is interrupted and it is returned an `Unauthorized` response
        $auth = Collection::from(explode(" ", $authorization))
            ->filter(function ($str) { return !empty($str); })
            ->values()
            ->toArray();

        $type  = $auth[0];
        $token = $auth[1];
        if ($type !== "Bearer")
            return $response
                ->withStatus(401)
                ->withJson([
                    "message" => "The token must be Bearer",
                    "code" => "@auth.401.1"
                ]);

        try {
            // Now check the token
            $user = R::find(
                Tables::USERS,
                "auth_key = ?",
                [
                    $token,
                ]
            );
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson([
                    "message" => "There is a problem querying the database.",
                    "code" => "@auth.500.1",
                ]);
        }

        return !empty($user) ?
            $next($request, $response) :
            $response
                ->withStatus(401)
                ->withJson([
                    "message" => "The token is invalid",
                    "code" => "@auth.401.2",
                ]);
    }

}