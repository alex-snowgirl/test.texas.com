<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 7:33 PM
 */
namespace CORE\Web\Response\ViewProcessor;

use CORE\Web\Response;
use CORE\Web\Response\ViewProcessor;

/**
 * Simple Bridge between HTML view and Web Response
 *
 * Class HTML
 * @package CORE\Web\Response\ViewProcessor
 */
class HTML extends ViewProcessor
{
    public function setHeaders(Response $response)
    {
        $response->addHeader('Content-Type: text/html');
        return $this;
    }
}