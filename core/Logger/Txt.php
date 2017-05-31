<?php
/**
 * Created by PhpStorm.
 * User: snowgirl
 * Date: 5/30/17
 * Time: 19:06 PM
 */
namespace CORE\Logger;

use CORE\Logger;

/**
 * Simple Txt Logger class
 *
 * Class Logger
 * @package CORE
 */
class Txt extends Logger
{
    protected $file;
    protected $dir;

    public function setFile($value)
    {
        $value = join(DIRECTORY_SEPARATOR, array(
            DOCUMENT_ROOT,
            $value
        ));

        if (file_exists($value) && is_writable($value)) {
            $this->file = $value;
            ini_set('error_log', $this->file);
        }

        return $this;
    }

    public function make($msg)
    {
        if ($this->file) {
            error_log(join(' ', array(
                    time(),
                    $msg
                )) . "\n", 3, $this->file);
        }

        return $this;
    }
}