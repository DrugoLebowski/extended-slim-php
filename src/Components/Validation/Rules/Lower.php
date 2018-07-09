<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class Lower
 * @package App\components\validation\rules
 */
class Lower implements Rule
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
    public function validate($data): bool
    {
        return $data < $this->referenceValue;
    }
}