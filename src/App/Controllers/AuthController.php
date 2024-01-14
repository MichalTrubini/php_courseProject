<?php

declare(strict_types=1);

namespace App\controllers;

use Framework\TemplateEngine;

class AuthController
{

    public function __construct(private TemplateEngine $view)
    {
    }
    
    public function register()
    {
        echo $this->view->render('/register.php');
    }
}