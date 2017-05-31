<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 5:26 PM
 */
namespace CORE\Web;

use CORE\View;
use CORE\Web\Response\ViewProcessor;

/**
 * Simple Web Response class
 *
 * Class Response
 * @package CORE\Web
 */
class Response extends \CORE\Response
{
    protected $code;
    protected $body;

    protected $codeToText = array(
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        429 => 'Too Many Requests',
        500 => 'Internal Server Error',
    );

    /**
     * @var View
     */
    protected $viewClass;

    /**
     * Constructor
     * View object - is a strategy of rendering (html, json, xml or something...)
     *
     * @param $viewClass
     */
    public function __construct($viewClass)
    {
        $this->viewClass = $viewClass;
    }

    protected $view;

    public function setView(View $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view ?: $this->view = new $this->viewClass;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    protected function sendBody()
    {
        echo $this->body;
    }

    protected $headers = array();

    /**
     * @param $header
     * @return Response
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * @return Response
     */
    protected function sendHeaders()
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        return $this;
    }

    public function send($die = false)
    {
        $this->addHeader('HTTP/1.1 ' . $this->code . ' ' . $this->codeToText[$this->code]);

        /**
         * Decorates View processing... (specific headers, specific format)
         * It could be configurable in the config file (and passed to this class as specific service)
         * Otherwise this shit broke Open-Closed Principle (hardcoded, but tried made it much more optimized)
         *
         * @todo implement Real NOrmal Dependency Container or Service Locator and use on whole project
         * @todo ...but I prefer direct params instead of global things...
         *
         * Or we might use Facade pattern over here...
         * If so - we'll receive next line only instead of $bridge calls:
         * ViewProcessor::make($this)
         */
        $bridge = ViewProcessor::make($this);

        $bridge->setHeaders($this)
            ->setParams($this);

        $this->setBody($this->getView())
            ->sendHeaders()
            ->sendBody();

        if ($die) {
            die;
        }
    }
}