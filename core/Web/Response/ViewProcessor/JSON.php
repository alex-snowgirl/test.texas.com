<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 7:33 PM
 */
namespace CORE\Web\Response\ViewProcessor;

use CORE\View;
use CORE\Web\Response;
use CORE\Web\Response\ViewProcessor;

/**
 * Simple Bridge between JSON view and Web Response
 *
 * Class JSON
 * @package CORE\Web\Response\ViewProcessor
 */
class JSON extends ViewProcessor
{
    public function setHeaders(Response $response)
    {
        $response->addHeader('Content-Type: application/json');
        return $this;
    }

    /**
     * Simple JSON view modifier (we will always have code and body keys on client side)
     * You could have an attitude to this like: it's the way my core works...
     * ...or to make things much more scalable and not hardcoded - transfer this stuff to the app namespace...
     *
     * @param Response $response
     * @return $this
     */
    public function setParams(Response $response)
    {
        $view = new View\JSON(array(
            'code' => $response->getCode(),
            'body' => $response->getView()->getParams()
        ));

        $response->setView($view);

        return $this;
    }
}