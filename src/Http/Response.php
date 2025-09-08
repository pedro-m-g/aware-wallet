<?php

namespace AwareWallet\Http;

class Response
{

    private int $status;
    private string $body;
    private array $headers;

    public function __construct(int $status = 200, string $body = '', array $headers = [])
    {
        $this->status = $status;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function send()
    {
        http_response_code($this->status);
        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }
        echo $this->body;
    }

}
