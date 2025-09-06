<?php

namespace AwareWallet\Http;

use AwareWallet\Context\ApplicationContext;
use AwareWallet\Services\Logging\Logger;
use Exception;

class Router
{

    private array $routes;
    private Logger $logger;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->logger = new Logger(Router::class);
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
            $this->logger->info('Matched route: ' . $path);
            $request->extractPathParams($path);
            $context->share(Request::class, fn($ctx) => $request);
            try {
                $response = (new $controller($context))->$action();
            } catch (Exception $ex) {
                $this->logger->error($ex->getMessage());
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
                $this->logger->error('Could not convert response to JSON');
                return new Response(500);
            }
            return new Response(200, $json, [
                'Content-Type' => 'application/json'
            ]);
        }
        $this->logger->error('Page not found: ' . $request->path());
        return new Response(404);
    }

    private function pathRegex(string $path): string
    {
        $withSlashesReplaced = str_replace('/', '\\/', $path);
        $withPlaceholdersReplaced = preg_replace('/\:[^\/]+/', '[^\\/]+', $withSlashesReplaced);
        return '/^' . $withPlaceholdersReplaced . '$/';
    }

}
