<?php

namespace App\Components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class Required
 * @package App\Components\Validation\Rules
 */
class Required implements Rule
{

    /**
     * Return `true` if the $value is not empty.
     *
     * @param $value
     * @return bool
     */
    public function validate($value): bool
    {
        return !is_null($value) && !empty($value);
    }

}
