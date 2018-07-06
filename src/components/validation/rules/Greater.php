<?php

namespace App\components\validation\rules;

/**
 * Class Greater
 * @package App\components\validation\rules
 */
class Greater
{

    /** @var float */
    private $referenceValue;

    /**
     * Greater constructor.
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
        return $data > $this->referenceValue;
    }
}