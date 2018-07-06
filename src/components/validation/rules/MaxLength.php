<?php

namespace App\components\validation\rules;

/**
 * Class MaxLength
 * @package App\components\validation\rules
 */
class MaxLength
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

    public function __invoke($data)
    {
        return count($data) <= $this->length;
    }

}