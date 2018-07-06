<?php

namespace App\components\validation\rules;

/**
 * Class Equal
 * @package App\components\validation\rules
 */
class Equal
{

    /** @var float */
    private $referenceValue;

    /**
     * Equal constructor.
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
    public function __invoke($data): bool
    {
        return $data == $this->referenceValue;
    }
}