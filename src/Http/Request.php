<?php

namespace AwareWallet\Http;

class Request
{

    private string $path;
    private string $method;
    private array $queryParams;
    private array $postParams;

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']) ?? 'GET';
        $this->queryParams = $_GET ?? [];
        $this->postParams = $_POST ?? [];
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

}
