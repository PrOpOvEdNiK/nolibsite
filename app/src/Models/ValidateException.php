<?php


namespace BS\Models;


class ValidateException extends \Exception
{
    public function __construct(array $message)
    {
        parent::__construct(serialize($message));
    }

    public function __toString()
    {
        $message = var_export($this->message, true);
        return __CLASS__ . ": [{$this->code}]: {$message}\n";
    }
}
