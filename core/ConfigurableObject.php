<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 11:21 AM
 */

namespace CORE;

/**
 * Simple Configurable Object
 *
 * Class ConfigurableObject
 * @package CORE
 */
abstract class ConfigurableObject extends \stdClass
{
    /**
     * @param object[]|\stdClass[]|array $config
     */
    public function __construct($config = array())
    {
        foreach ($config as $k => $v) {
            $this->setConfigOption($k, $v);
        }
    }

    /**
     * @param $rawKey
     * @param $value
     * @return $this
     */
    public function setConfigOption($rawKey, $value)
    {
//        $isFirstCharUpper = $rawKey[0] != strtolower($rawKey[0]);
        $tmp = str_replace(' ', '', ucwords(join(' ', explode('_', $rawKey))));

//        $key = $isFirstCharUpper ? $tmp : lcfirst($tmp);
        $setter = 'set' . $tmp;

        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
//            $this->$key = $value;
            $this->$rawKey = $value;
        }

        return $this;
    }
}