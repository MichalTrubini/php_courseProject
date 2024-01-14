<?php

declare(strict_types=1);

use Framework\TemplateEngine;
use App\config\Paths;
use App\Services\ValidatorService;

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn() => new ValidatorService()
];