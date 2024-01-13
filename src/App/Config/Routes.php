<?php

declare(strict_types=1);

namespace App\config;

use Framework\App;
use App\Controllers\{HomeController, AboutController};

$app = new App();

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
}
