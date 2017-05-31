<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 11:47 PM
 */
namespace CORE;

/**
 * Simple Handler Container (in other words - Controller...)
 *
 * Interface HandlerContainer
 * @package CORE
 */
abstract class HandlerContainer
{
    public function bindHandlers(Request $request)
    {
        $this->bindCustom($request);
        $this->bindDefault($request);
    }

    abstract public function bindCustom(Request $request);

    abstract public function bindDefault(Request $request);
}