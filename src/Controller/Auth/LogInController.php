<?php

namespace AwareWallet\Controller\Auth;

use AwareWallet\Context\ApplicationContext;
use AwareWallet\Controller\Controller;

class LogInController extends Controller
{

    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context);
    }

    public function show()
    {
        return $this->view('auth/login');
    }

}
