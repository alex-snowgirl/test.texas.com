<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 11:06 PM
 */
namespace CORE;

/**
 * Simple Universal APP class
 * Simple Service Locator class (@see __get)
 *
 * Class App
 * @package CORE
 * @property Request|\CORE\Web\Request $request
 * @property HandlerContainer $handlerContainer
 * @property Response|\CORE\Web\Response $response
 * @property RDBMS $rdbms
 * @property Logger $logger
 */
class App
{
    use Observable;

    const EVENT_EXCEPTION = 0;
    const EVENT_PRE_RUN = 1;
    const EVENT_POST_RUN = 2;

    /**
     * Public for simple access interface @todo...
     * @var Config
     */
    public $config;
    /**
     * Public for simple access interface @todo...
     * @var Request
     */
    public $request;
    /**
     * Public for simple access interface @todo...
     * @var HandlerContainer
     */
    public $handlerContainer;
    /**
     * Public for simple access interface @todo...
     * @var Response
     */
    public $response;

    public function __construct(Config $config, Request $request, HandlerContainer $handlerContainer, Response $response)
    {
        $this->config = $config;
        $this->request = $request;
        $this->handlerContainer = $handlerContainer;
        $this->response = $response;
    }

    protected function executeHandler($handler)
    {
        if ($handler instanceof \Closure) {
            $handler($this);
        } elseif (is_callable($handler, true)) {
            call_user_func($handler, $this);
        } else {
            //@todo...
        }
    }

    public function run()
    {
        $this->trigger(self::EVENT_PRE_RUN);
        try {
            try {
                $this->handlerContainer->bindHandlers($this->request);
                $handler = $this->request->parse();
                $this->executeHandler($handler);
                $this->response->send();
            } catch (\Exception $ex) {
//                var_dump($ex->getMessage(),$ex->getCode());die;
                throw new Exception($ex->getMessage(), $ex->getCode(), $ex);
            }
        } catch (Exception $ex) {
            $this->logger->makeException($ex);
            $this->trigger(self::EVENT_EXCEPTION, $ex);
        }

        $this->trigger(self::EVENT_POST_RUN);
    }

    /**
     * Simple Service Locator
     *
     * @param $k
     * @return null
     */
    public function __get($k)
    {
        $lowerK = strtolower($k);

        if (property_exists($this, $lowerK)) {
            return $this->$lowerK;
        }

        $v = null;

        $services = $this->config->service;

        $servicePrefix = '@';

        foreach ($services as $name => $service) {
            if (0 === strcasecmp($name, $k)) {
                $provider = $this->config->service->$name;
                $config = $this->config->{$name . '.' . $provider};

                foreach ($config as $configKey => $configValue) {
                    if (0 === strpos($configValue, $servicePrefix)) {
                        $serviceName = ltrim($configValue, $servicePrefix);
                        $config->$configKey = &$this->$serviceName;
                    }
                }

                $class = join('\\', array(
                    __NAMESPACE__,
                    $name,
                    $provider
                ));

                $v = new $class($config);

                $k = $lowerK;
                break;
            }
        }

        return $this->$k = $v;
    }
}