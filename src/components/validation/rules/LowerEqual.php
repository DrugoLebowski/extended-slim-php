<?php

namespace App\components\validation\rules;

/**
 * Class LowerEqual
 * @package App\components\validation\rules
 */
class LowerEqual
{

    /** @var float */
    private $referenceValue;

    /**
     * LowerEqual constructor.
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
        return $data <= $this->referenceValue;
    }
}