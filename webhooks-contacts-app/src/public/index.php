<?php
/*
include_once '../../vendor/autoload.php';

try {
    session_start();
    \Repositories\EventsRepository::createTableIfNotExists();
    $uri = parse_url($_SERVER["REQUEST_URI"])['path'];
    switch ($uri) {
        case '/' :
            header('Location: /webhooks/events.php');
            exit();
        case '/webhooks/events.php':
        case '/webhooks/handle.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
            $path = __DIR__ .'/../actions'. $uri;
            require $path;
            exit();
        default:
            http_response_code(404);
            exit();
    }
} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__.'/../views/error.php';
    exit();
}*/


use Helpers\Oauth2Helper;
use Repositories\EventsRepository;

include_once '../../vendor/autoload.php';

session_start();
$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

try {
    EventsRepository::createTableIfNotExists();
    switch ($uri) {
        // allowed for anonymous
        case '/oauth/login.php':
        case '/oauth/authorize.php':
        case '/oauth/callback.php':
            $path = __DIR__ . '/../actions' . $uri;
            require $path;
            exit();
    }

    if (!Oauth2Helper::isAuthenticated()) {
        header('Location: /oauth/login.php');
        exit();
    }

    switch ($uri) {
        // protected
        case '/' :
            header('Location: /webhooks/events.php');
            exit();
        case '/webhooks/events.php':
        case '/webhooks/handle.php':
            $path = __DIR__ . '/../actions' . $uri;
            require $path;
            exit();
        default:
            http_response_code(404);
            exit();
    }
} catch (Throwable $t) {
    $message = $t->getMessage();
    include __DIR__ . '/../views/error.php';
    exit();
}

