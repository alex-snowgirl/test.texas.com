<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 7:29 PM
 */

/**
 * Simple init logic:
 * 1) Default timezone = Europe/Kiev
 * 2) Default error log file = log.app
 * 3) All errors will thrown exceptions
 * 4) All exceptions will be logged into default log file
 * 5) Last error will be logged into default log file
 * 6) Defines DOCUMENT_ROOT
 * 7) Returns composer loader
 */

date_default_timezone_set('Europe/Kiev');
ini_set('error_log', __DIR__ . '/log.app');

/**
 * Simple initial logger
 *
 * @param $text
 */
function LogMeFaster($text)
{
    error_log($text . "\n", 3, ini_get('error_log'));
}

/**
 * Simple error handler
 */
set_error_handler(function ($num, $str, $file, $line) {
    throw new Exception(join(' - ', array_slice(func_get_args(), 0, 4)));
});

/**
 * Simple exception handler
 */
set_exception_handler(function (\Exception $ex) {
    LogMeFaster(join("\n", array(
        join(' - ', array($ex->getCode(), $ex->getMessage())),
        $ex->getTraceAsString()
    )));
});

/**
 * Simple shutdown handler
 */
register_shutdown_function(function () {
    if (!$e = error_get_last()) {
        return true;
    }

    LogMeFaster(join(' - ', $e));

    return true;
});

/**
 * Which we are using in our classes - it's not good idea, but for such test project - it's fair enough
 * @todo create config fields $documentRoot and pass it where they are using...
 */
defined('DOCUMENT_ROOT') || define('DOCUMENT_ROOT', realpath(__DIR__));

return require_once 'vendor/autoload.php';