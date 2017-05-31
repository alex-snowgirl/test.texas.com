<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 4/14/17
 * Time: 7:41 PM
 */
use CORE\App;
use CORE\Config;

/**
 * We do use Web stuff for simplicity
 * @todo create and implement native API stuff (Request, Response etc..)
 */
use CORE\Web\Request;
use CORE\Web\Response;

use CORE\View\JSON;
/**
 * We do use single global API container for simplicity (No routes, no Controllers)
 */
use APP\Controller\Api\HandlerContainer;
use CORE\Exception;

$loader = require_once '../ini.php';

/**
 * Simple application with wide control (mounted components)
 * @todo implement lazy creations and encapsulations of components when we have separated APPs
 */
$app = new App(
    new Config(__DIR__ . '/../config.ini'),
    new Request(),
    new HandlerContainer(),
    new Response(JSON::class)
);

$app->on(App::EVENT_EXCEPTION, function (App $app, Exception $ex) {
    $app->response->setCode(500);

    if ('dev' == $app->config->app->env) {
        $app->response->setBody($ex->getTraceAsString());
    } else {
        $app->response->setBody('Ooops! Something bad happened over here...');
    }

    $app->response->send();
});

$app->run();