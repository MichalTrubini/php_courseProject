<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\config\Paths;

use function App\config\registerRoutes;

$app = new App(PATHS::SOURCE . 'app/container-definitions.php');

registerRoutes($app);

return $app;
