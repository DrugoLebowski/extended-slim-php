<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class GreaterEqual
 * @package App\components\validation\rules
 */
class GreaterEqual implements Rule
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
    public function validate($data): bool
    {
        return $data >= $this->referenceValue;
    }
}