<?php

namespace App\components\validation\rules;

/**
 * Class MinLength
 * @package App\components\validation\rules
 */
class MinLength
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

    public function __invoke($data)
    {
        return count($data) >= $this->length;
    }

}