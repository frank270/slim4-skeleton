<?php

use App\Middleware\TranslatorMiddleware;
use App\Middleware\UrlGeneratorMiddleware;
use Odan\Session\Middleware\SessionMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    $app->add(ValidationExceptionMiddleware::class);
    $app->add(TranslatorMiddleware::class);
    $app->add(SessionMiddleware::class);
    $app->add(UrlGeneratorMiddleware::class);
    $app->addRoutingMiddleware();
    $app->add(TwigMiddleware::class);
    $app->add(BasePathMiddleware::class);
    $app->add(ErrorMiddleware::class);
};
