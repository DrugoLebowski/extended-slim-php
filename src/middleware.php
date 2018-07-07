<?php
// Application middleware

// Vendor
use App\Components\Validation\Validator;
use Slim\Http\Request;
use Slim\Http\Response;

// Enable CORS
$app->add(
    function (Request $req, Response $res, $next) {
        /** @var Request $request */
        $request = $next($req, $res);
        return $request
            ->withHeader(
                'Access-Control-Allow-Origin',
                "{$_SERVER["HTTP_HOST"]}"
            )
            ->withHeader(
                'Access-Control-Allow-Headers',
                'X-Requested-With, Content-Type, Accept, Origin, Authorization'
            )
            ->withHeader(
                'Access-Control-Allow-Methods',
                'GET, POST, PUT, DELETE, PATCH, OPTIONS'
            )
            ->withHeader(
                "Access-Control-Allow-Credentials",
                "true"
            );
    }
);

// Check the validity of the data for the requested route
$app->add(function (Request $request, Response $response, $next) use ($app) {
    $callable = explode(
        ":",
        (string) $request->getAttribute("route")->getCallable()
    );

    // Get the controller and the action
    $controller = $callable[0];
    $action     = $callable[1];

    // Get the rules
    $rules = $app->getContainer()->get("validation_rules")($controller, $action);
    $parameters = array_merge(
        $request->getAttribute("routeInfo")[2],
        $request->getParams() ?? []
    );

    $validation = Validator::validate($parameters, $rules);
    return !$validation->isResult() ?
        $response->withStatus(400)->withJson($validation->getParam()) :
        $next($request, $response);
});

// Check if the requested route belongs to API routes or not
$app->add(function (Request $request, Response $response, $next) {
    return !is_null($request->getAttribute("route")) ? // if the path does not start with /api, then is served the page index.html
        $next($request, $response) :
        $this->view->render($response, "index.html");
});
