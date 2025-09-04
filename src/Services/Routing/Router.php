<?php

namespace AwareWallet\Services\Routing;

use AwareWallet\Http\Request;
use AwareWallet\Http\Response;
use Exception;

class Router
{

    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {
            [$method, $path, $controller, $action] = $route;
            if ($path !== $request->path()) {
                continue;
            }
            if ($method !== $request->method()) {
                continue;
            }
            try {
                $response = (new $controller())->$action();
            } catch (Exception) {
                return new Response(500);
            }
            if ($response instanceof Response) {
                return $response;
            }
            if ($response instanceof string) {
                return new Response(200, $response);
            }
            $json = json_encode($response);
            if ($json === false) {
                return new Response(500);
            }
            return new Response(200, $json, [
                'Content-Type' => 'application/json'
            ]);
        }
        return new Response(404);
    }

}
