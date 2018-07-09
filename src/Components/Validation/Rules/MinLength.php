<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class MinLength
 * @package App\components\validation\rules
 */
class MinLength implements Rule
{

    /** @var int */
    private $length;

    /**
     * MinLength constructor.
     * @param int $length
     */
    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public function validate($data): bool
    {
        return count($data) >= $this->length;
    }

}