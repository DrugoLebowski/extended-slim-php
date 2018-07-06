<?php

namespace App\components\validation\rules;

/**
 * Class Lower
 * @package App\components\validation\rules
 */
class Lower
{

    /** @var float */
    private $referenceValue;

    /**
     * Lower constructor.
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
        return $data < $this->referenceValue;
    }
}