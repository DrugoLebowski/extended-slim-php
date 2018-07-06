<?php

namespace App\Components\Validation\Rules;

/**
 * Class Required
 * @package App\Components\Validation\Rules
 */
class Required
{

    /**
     * Return `true` if the $value is not empty.
     *
     * @param $value
     * @return bool
     */
    public function __invoke($value): bool
    {
        return !is_null($value) && !empty($value);
    }

}
