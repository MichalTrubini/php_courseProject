<?php

declare(strict_types=1);

namespace App\controllers;

use Framework\TemplateEngine;
use App\config\Paths;

class AboutController
{

    public function __construct(private TemplateEngine $view)
    {
    }

    public function about()
    {
        echo $this->view->render('/about.php', ['title' => 'About Page', 'dangerousData' => '<script>alert("XSS Attack")</script>']);
    }
}
