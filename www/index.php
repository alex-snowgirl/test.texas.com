<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 5:13 PM
 */
use CORE\App;
use CORE\Config;

use CORE\Web\Request;
use CORE\View\HTML;
use CORE\Web\Response;
/**
 * We do use single global WEB container for simplicity (No routes, no Controllers)
 */
use APP\Controller\Web\HandlerContainer;
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
    new Response(HTML::class)
);

//require_once '../data-generator.php';

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