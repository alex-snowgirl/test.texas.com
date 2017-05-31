<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 2:06 PM
 */
namespace CORE;

/**
 *
 * Simple File Config class
 * @todo add abstraction layer (which do not depends on files..) and extends from it
 *
 * For 1st level of config settings
 *
 * Class Config
 * @package CORE
 */
class Config extends ConfigurableObject
{
    public function __construct($file)
    {
        parent::__construct(array_map(function ($v) {
            return new ConfigOption($v);
        }, parse_ini_file($file, true)));
    }

    public function __get($k)
    {
        return new ConfigOption(array());
//        return $this->$k = new ConfigOption(array());
    }
}

/**
 * For 2nd level of config settings
 * We have both classes in one place - coz they are linked and this one is using by above one only
 *
 * Class ConfigOption
 * @package CORE
 */
class ConfigOption extends ConfigurableObject
{
    public function __get($k)
    {
        return null;
//        return $this->$k = null;
    }

    /**
     * For retrieve properties with default values
     *
     * @param $name
     * @param array $arguments
     * @return mixed|null
     */
    public function __call($name, array $arguments)
    {
        if (property_exists($this, $name)) {
            $output = $this->$name;
        } else {
            $output = isset($arguments[0]) ? $arguments[0] : null;
        }

        return $output;
    }
}