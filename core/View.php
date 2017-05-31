<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 7:34 PM
 */
namespace CORE;

/**
 * Simple View Class
 * @todo add logger...
 *
 * Interface View
 * @package CORE
 */
abstract class View extends ConfigurableObject
{
    /**
     * Simple setter
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->$key = $value;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        foreach ($params as $key => $value) {
            $this->setParam($key, $value);
        }

        return $this;
    }

    public function getParams()
    {
        return (array)$this;
    }

    abstract protected function stringify();

    public function __toString()
    {
        return $this->stringify();
    }
}