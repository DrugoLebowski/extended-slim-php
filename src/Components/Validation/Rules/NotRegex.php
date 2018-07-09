<?php

namespace App\Components\Validation\Rules;

use App\Components\Validation\Exceptions\InvalidRuleException;
use App\Components\Validation\Interfaces\Rule;

/**
 * Class NotRegex
 * @package App\Components\Validation\Rules
 */
class NotRegex implements Rule
{

    /** @var int */
    private $rule;

    /**
     * Logical constructor.
     * @param string $rule
     * @param bool $conditionMustBe
     * @throws \Exception
     */
    public function __construct($rule)
    {
        $regularExpressionTester = "/^\/.+\/[gimuy]*$/";
        if (!preg_match($regularExpressionTester, $rule))
            throw new InvalidRuleException("The string is not a regular expression.");

        $this->rule = $rule;
    }

    /**
     * Validate the passed content
     *
     * @param $content
     * @return bool
     */
    public function validate($content): bool
    {
        return !preg_match($this->rule, $content);
    }
}
