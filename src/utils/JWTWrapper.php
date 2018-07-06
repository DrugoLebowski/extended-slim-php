<?php

namespace App\Utils;

use \Firebase\JWT\JWT;

class JWTWrapper
{
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Encode the payload into a JWT envelope.
     *
     * @param $payload
     * @return string
     */
    public function encode($payload): string
    {
        return JWT::encode($payload, $this->key);
    }

    /**
     * Decode the JWT envelope, if it is possible.
     *
     * @param $envelope
     * @return object
     */
    public function decode($envelope)
    {
        return JWT::decode($envelope, $this->key);
    }
}