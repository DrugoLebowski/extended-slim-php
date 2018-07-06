<?php

namespace App\components\validation\rules;

/**
 * Class EqualLength
 * @package App\components\validation\rules
 */
class EqualLength
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
    public function __invoke($data): bool
    {
        return count($data) === $this->length;
    }

}