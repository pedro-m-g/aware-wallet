<?php

namespace AwareWallet\Http;

use AwareWallet\Context\ApplicationContext;
use Exception;

class Router
{

    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(ApplicationContext $context): Response
    {
        $request = new Request();
        foreach ($this->routes as $route) {
            [$method, $path, $controller, $action] = $route;
            if (!preg_match($this->pathRegex($path), $request->path())) {
                continue;
            }
            if ($method !== $request->method()) {
                continue;
            }
            $request->extractPathParams($path);
            $context->share(Request::class, fn($ctx) => $request);
            try {
                $response = (new $controller($context))->$action();
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

    private function pathRegex(string $path): string
    {
        $withSlashesReplaced = str_replace('/', '\\/', $path);
        $withPlaceholdersReplaced = preg_replace('/\:[^\/]+/', '[^\\/]+', $withSlashesReplaced);
        return '/^' . $withPlaceholdersReplaced . '$/';
    }

}
