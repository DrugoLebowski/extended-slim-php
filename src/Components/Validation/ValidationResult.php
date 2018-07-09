<?php

namespace App\Components\Validation;

/**
 * Class ValidationResult
 * @package App\Components\Validation
 */
class ValidationResult
{

    const OK = 0;
    const ERR_UNPROTECTED_ROUTES      = 1;
    const ERR_UNEXPECTED_PARAMS       = 2;
    const ERR_NO_SENT_PARAMS          = 3;
    const ERR_VALIDATION              = 4;
    const ERR_INCOMPATIBLE_RULES_DATA = 5;

    /** @var bool $passed */
    private $passed;

    /** @var integer $type */
    private $type;

    /** @var array $param */
    private $param;

    /**
     * ValidationResult constructor.
     *
     * @param int $type
     * @param string $param
     */
    public function __construct(int $type = self::OK, string $param = null)
    {
        $this->passed = $type === self::OK;
        $this->type   = $type;
        $this->param  = $param;
    }

    /**
     * @return bool
     */
    public function isPassed(): bool
    {
        return $this->passed;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getParam(): string
    {
        return $this->param;
    }


}