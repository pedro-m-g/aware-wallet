<?php

namespace AwareWallet\Http;

class Request
{

    private string $path;
    private string $method;
    private array $queryParams;
    private array $postParams;
    private array $pathParams;

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']) ?? 'GET';
        $this->queryParams = $_GET ?? [];
        $this->postParams = $_POST ?? [];
        $this->pathParams = [];
    }

    public function path()
    {
        return $this->path;
    }

    public function method()
    {
        return $this->method;
    }

    public function queryParams()
    {
        return $this->queryParams;
    }

    public function postParams()
    {
        return $this->postParams;
    }

    public function pathParams()
    {
        return $this->pathParams;
    }

    public function addPathParam(string $param, string $value)
    {
        $this->pathParams[$param] = $value;
    }

    public function extractPathParams(string $path)
    {
        $routeComponents = explode('/', $path);
        $pathComponents = explode('/', $this->path);
        for ($i = 0; $i < count($routeComponents); $i++) {
            $routeSegment = $routeComponents[$i];
            if (!str_starts_with($routeSegment, ':')) {
                continue;
            }
            $pathSegment = $pathComponents[$i];
            $this->addPathParam(substr($routeSegment, 1), $pathSegment);
        }
    }

}
