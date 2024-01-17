<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\config\Paths;
use Dotenv\Dotenv;

use function App\config\{registerRoutes, registerMiddleware};

$dotenv = Dotenv::createImmutable(PATHS::ROOT);
$dotenv->load();

$app = new App(PATHS::SOURCE . 'app/container-definitions.php');

registerRoutes($app);
registerMiddleware($app);

return $app;
