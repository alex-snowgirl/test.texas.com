<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/31/17
 * Time: 5:26 PM
 */
namespace CORE;

/**
 * Simple Abstract Response
 *
 * Class Response
 * @package CORE
 */
abstract class Response
{
    abstract public function send($die = false);
}