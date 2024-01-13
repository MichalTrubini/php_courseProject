<?php

declare(strict_types=1);

namespace App\controllers;

use Framework\TemplateEngine;
use App\config\Paths;

class HomeController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }
    
    public function home()
    {
        $this->view->render('/index.php');
    }
}