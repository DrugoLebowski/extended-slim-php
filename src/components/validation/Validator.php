<?php

namespace App\Components\Validation;

use App\Components\Validation\Rules;

class Validator
{

    /**
     * Validate the passed parameters and prune the unexpected parameters.
     *
     * @param array $parameters
     * @param array $rules
     * @return ValidationResult
     * @throws \Exception
     */
    public static function validate($parameters, $rules): ValidationResult
    {
        // Unprotected route
        if (is_null($rules))
            return new ValidationResult(
                false,
                [
                    "code" => "@validation.error.0"
                ]
            );

        $rules = RulesParser::parse($rules);

        // Search for unexpected parameters
        $expectedParameters = array_keys($rules);
        $unexpectedParameters = array_filter(
            $parameters,
            function ($value, $key) use ($expectedParameters) {
                return array_search(
                        $key,
                        $expectedParameters,
                        true
                ) === false;
            },
            ARRAY_FILTER_USE_BOTH
        );

        // There are some unexpected parameters
        if (count($unexpectedParameters) > 0)
            return new ValidationResult(
                false,
                [
                    "code" => "@validation.error.1",
                ]
            );
        // The client has not sent parameters
        else if (count($parameters) === 0 && count($rules) > 0)
            return new ValidationResult(
                false,
                [
                    "code" => "@validation.error.2",
                ]
            );

        /**
         * @var string $field
         * @var mixed $content
         */
        foreach ($parameters as $key => $content) { // Validate each remaining parameter
            /** @var Rules $rule */
            $rule = $rules[$key];

            // Check the validity of the rules
            if (!$rule($content))
                return new ValidationResult(
                    false,
                    [
                        "key"     => $key,
                        "code"    => "@validation.error.3",
                    ]
                );
        }

        return new ValidationResult(true);
    }

}