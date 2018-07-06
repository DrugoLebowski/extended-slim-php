<?php

namespace App\Components\Validation\Rules;

class NotRegex
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
            throw new \Exception("The string is not a regular expression.");

        $this->rule = $rule;
    }

    /**
     * Validate the passed content
     *
     * @param $content
     * @return bool
     */
    public function __invoke($content)
    {
        return !preg_match($this->rule, $content);
    }
}
