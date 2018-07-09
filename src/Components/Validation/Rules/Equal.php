<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class Equal
 * @package App\components\validation\rules
 */
class Equal implements Rule
{

    /** @var float */
    private $referenceValue;

    /**
     * Equal constructor.
     * @param float $referenceValue
     */
    public function __construct($referenceValue)
    {
        $this->referenceValue = $referenceValue;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        return $data == $this->referenceValue;
    }
}