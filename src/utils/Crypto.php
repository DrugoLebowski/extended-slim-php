<?php

namespace App\Utils;

class Crypto
{
    /** @var string */
    private $salt;

    public function __construct($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Return the hashed encrypted $value.
     *
     * @param mixed $value
     * @return string
     */
    public function crypt($value): string
    {
        return crypt($value, $this->salt);
    }

}