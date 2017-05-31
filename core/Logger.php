<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 3:18 PM
 */
namespace CORE;

/**
 * Simple Logger class (for the purpose of SOLID principles)
 *
 * @todo implement types (debug, info, error etc...)
 * @todo implement client id logging (pass as config option)
 *
 * Class Logger
 * @package CORE
 */
abstract class Logger extends ConfigurableObject
{
    abstract public function make($msg);

    public function makeException(Exception $ex)
    {
        if ($ex->isLogged()) {
            return $this;
        }

        $ex->setLogged();

        return $this->make(join("\r\n", array(
            $ex->getMessage(),
            $ex->getTraceAsString()
        )));
    }
}