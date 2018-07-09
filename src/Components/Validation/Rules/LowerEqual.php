<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class LowerEqual
 * @package App\components\validation\rules
 */
class LowerEqual implements Rule
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
    public function validate($data): bool
    {
        return $data <= $this->referenceValue;
    }
}