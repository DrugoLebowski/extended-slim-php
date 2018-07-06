<?php

namespace App\Components\Validation;


class Rules
{
    /** @var int */
    private $type;

    /** @var array */
    private $rules;

    /**
     * Rules constructor.
     * @param int $fieldType
     * @param array $rules
     * @param bool $required
     */
    public function __construct($type, $rules = [])
    {
        $this->type = $type;
        $this->rules = $rules;
    }

    /**
     * Validate the $content using the validation rules.
     *
     * @param mixed $content
     * @return bool
     */
    public function __invoke($content): bool
    {
        return array_reduce(
            $this->rules,
            function ($reduced, $rule) use ($content) {
                return $reduced && $rule($content);
            },
            true
        );
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

}
