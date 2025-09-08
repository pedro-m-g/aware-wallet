<?php

namespace AwareWallet\Http;

use AwareWallet\Collection\ParameterCollection;

class Request
{

    private string $path;
    private string $method;
    private ParameterCollection $queryParams;
    private ParameterCollection $postParams;
    private ParameterCollection $pathParams;

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']) ?? 'GET';
        $this->queryParams = new ParameterCollection($_GET ?? []);
        $this->postParams = new ParameterCollection($_POST ?? []);
        $this->pathParams = new ParameterCollection([]);
    }

    public function path(): string
    {
        return $this->path;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function queryParams(): ParameterCollection
    {
        return $this->queryParams;
    }

    public function postParams(): ParameterCollection
    {
        return $this->postParams;
    }

    public function pathParams(): ParameterCollection
    {
        return $this->pathParams;
    }

    public function addPathParam(string $param, string $value)
    {
        $this->pathParams->add($param, $value);
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
