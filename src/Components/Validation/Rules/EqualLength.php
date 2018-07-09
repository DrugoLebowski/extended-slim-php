<?php

namespace App\components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;

/**
 * Class EqualLength
 * @package App\components\validation\rules
 */
class EqualLength implements Rule
{

    /** @var int */
    private $length;

    /**
     * EqualLength constructor.
     * @param int $length
     */
    public function __construct(int $length)
    {
        $this->length = $length;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        return count($data) === $this->length;
    }

}