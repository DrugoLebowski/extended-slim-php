<?php

namespace App\components\validation\rules;

/**
 * Class GreaterEqual
 * @package App\components\validation\rules
 */
class GreaterEqual
{

    /** @var float */
    private $referenceValue;

    /**
     * GreaterEqual constructor.
     * @param float $referenceValue
     */
    public function __construct(float $referenceValue)
    {
        $this->referenceValue = $referenceValue;
    }

    /**
     * @param $data
     * @return bool
     */
    public function __invoke($data)
    {
        return $data >= $this->referenceValue;
    }
}