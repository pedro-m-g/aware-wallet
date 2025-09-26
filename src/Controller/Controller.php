<?php

namespace AwareWallet\Controller;

use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Request;
use AwareWallet\Http\Response;
use AwareWallet\Services\View\ViewRenderer;

class Controller
{

    private ApplicationContext $context;

    public function __construct(ApplicationContext $context)
    {
        $this->context = $context;
    }

    protected function context()
    {
        return $this->context;
    }

    protected function request(): Request
    {
        return $this->context->get(Request::class);
    }

    protected function viewRenderer(): ViewRenderer
    {
        return $this->context->get(ViewRenderer::class);
    }

    protected function view(string $view, array $vars = [], int $status = 200)
    {
        $body = $this->viewRenderer()->render($view, $vars);
        $headers = [
            'Content-Type' => 'text/html'
        ];
        return new Response($status, $body, $headers);
    }

}
