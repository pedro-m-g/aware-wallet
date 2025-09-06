<?php

namespace AwareWallet\Controller;

use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Request;

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

}
