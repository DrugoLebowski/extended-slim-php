<?php

namespace App\Components\Validation;

/**
 * Class ValidationResult
 * @package App\Components\Validation
 */
class ValidationResult
{
    /** @var bool $result */
    private $result;

    /** @var array $message */
    private $message;

    /**
     * ValidationResult constructor.
     * @param $result
     * @param array $message
     */
    public function __construct($result, $message = [])
    {
        $this->result     = $result;
        $this->message    = $message;
    }

    /**
     * @return bool
     */
    public function isResult(): bool
    {
        return $this->result;
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

}