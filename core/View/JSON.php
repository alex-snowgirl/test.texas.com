<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 19:17 PM
 */
namespace CORE\View;

use CORE\View;

/**
 * Simple JSON View
 *
 * Class JSON
 * @package CORE\View
 */
class JSON extends View
{
    protected function stringify()
    {
        return json_encode($this->getParams());
    }
}