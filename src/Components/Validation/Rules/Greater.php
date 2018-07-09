<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class Greater
 * @package App\components\validation\rules
 */
class Greater implements Rule
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
    public function validate($data): bool
    {
        return $data > $this->referenceValue;
    }
}