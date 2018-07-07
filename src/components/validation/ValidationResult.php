<?php

namespace App\Components\Validation;

/**
 * Class ValidationResult
 * @package App\Components\Validation
 */
class ValidationResult
{

    const OK = 0;
    const ERR_UNPROTECTED_ROUTES = 1;
    const ERR_UNEXPECTED_PARAMS  = 2;
    const ERR_NO_SENT_PARAMS     = 3;
    const ERR_VALIDATION         = 4;

    /** @var bool $result */
    private $result;

    /** @var integer $type */
    private $type;

    /** @var array $param */
    private $param;

    /**
     * ValidationResult constructor.
     * @param bool   $result
     * @param int    $type
     * @param string $param
     */
    public function __construct(int $type = self::OK, string $param = null)
    {
        $this->result = $type === self::OK;
        $this->type   = $type;
        $this->param  = $param;
    }

    /**
     * @return bool
     */
    public function isResult(): bool
    {
        return $this->result;
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
    public function getParam(): array
    {
        return $this->param;
    }


}