<?php

namespace AwareWallet\Controller;

use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Request;
use AwareWallet\Http\Response;

class HomeController
{

    private Request $request;

    public function __construct(ApplicationContext $context)
    {
        $this->request = $context->get(Request::class);
    }

    public function index()
    {
        return new Response(200, '<h1>Hello Controller</h1>', [
            'Content-Type' => 'text/html'
        ]);
    }

    public function welcome()
    {
        $name = $this->request->pathParams()['name'];
        return new Response(200, '<h1>Welcome ' . $name . '</h1>', [
            'Content-Type' => 'text/html'
        ]);
    }

}
