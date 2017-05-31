<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 7:34 PM
 */
namespace CORE\Web\Response;

use CORE\View;
use CORE\Web\Response;

/**
 * Simple Bridge between View and Web Response
 *
 * Class ViewProcessor
 * @package CORE\Web\Response
 */
abstract class ViewProcessor
{
    /**
     * Universal Factory method (instead of Factory Method)
     * @param Response $response
     * @return ViewProcessor
     */
    public static function make(Response $response)
    {
        $view = $response->getView();
        $class = str_replace('CORE\View', 'CORE\Web\Response\ViewProcessor', get_class($view));
        return new $class($response);
    }

    /**
     * Mandatory view modifier
     * @todo add response type when PHP7
     *
     * @param Response $response
     * @return $this
     */
    abstract public function setHeaders(Response $response);

    /**
     * Not mandatory view modifier
     *
     * @param Response $response
     * @return $this
     */
    public function setParams(Response $response)
    {
        return $this;
    }
}