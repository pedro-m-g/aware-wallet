<?php

namespace AwareWallet\Services\View;

use RuntimeException;

class ViewNotFoundException extends RuntimeException
{

    private string $viewsDir;
    private string $view;

    public function __construct(string $viewsDir, string $view)
    {
        parent::__construct(
            "View $view not found at $viewsDir");
        $this->viewsDir = $viewsDir;
        $this->view = $view;
    }

    public function viewsDir()
    {
        return $this->viewsDir;
    }

    public function view()
    {
        return $this->view;
    }

}
