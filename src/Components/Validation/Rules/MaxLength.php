<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class MaxLength
 * @package App\components\validation\rules
 */
class MaxLength implements Rule
{

    /** @var int */
    private $length;

    /**
     * MaxLength constructor.
     * @param int $length
     */
    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public function validate($data): bool
    {
        return count($data) <= $this->length;
    }

}