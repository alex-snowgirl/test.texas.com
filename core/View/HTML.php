<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 17:00 PM
 */
namespace CORE\View;

use CORE\Exception;
use CORE\View;

/**
 * Simple HTML View
 * @todo add driver (Twig, Smarty etc.)
 * @todo or even better create each of them under CORE\View\Html namespace... (according to SOLID)
 *
 * Class HTML
 * @package CORE\View
 */
class HTML extends View
{
    protected $template;

    /**
     * @todo validate...
     *
     * @param $value
     * @return $this
     */
    protected function setTemplate($value)
    {
        $this->template = $value;
        return $this;
    }

    /**
     * Simple template path maker
     * ...assuming we do not have any other views dirs...
     * @todo pass source dirs (relative to document root) into this class config
     * @todo ...and implement searching from first to last dir (priority is a must, for example - [app, core])
     * @todo ...or set up dir option directly and use it...
     * @todo ... or use Registry object (if exists) and retrieve configs (doc root, possible sources)
     * @todo ... or use Dependency Container (if exists) and retrieve some useful from there
     *
     * @return string
     */
    protected function makeTemplatePath()
    {
        return join(DIRECTORY_SEPARATOR, array(
            DOCUMENT_ROOT,
            'app',
            'View',
            $this->template . '.phtml'
        ));
    }

    public function stringify()
    {
        $level = ob_get_level();
        ob_start();

        /**
         * Simple output
         * We do catch exceptions for rendering at least something (other blocks will be displayed)...
         */
        try {
            /** @noinspection PhpIncludeInspection */
//            var_dump($this->makeTemplatePath());die;
            include $this->makeTemplatePath();
        } catch (\Exception $ex) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }

            /**
             * @todo add logger and logs..
             * $this->logger->makeException($ex);
             */

            LogMeFaster($ex->getTraceAsString());

            echo '<pre>';
            var_dump($ex->getTraceAsString());

            echo 'Error';
        }

        return ob_get_clean();
    }
}