<?php

namespace App\Components\Validation;

class Validator
{

    /**
     * Validate the passed parameters and prune the unexpected parameters.
     * The used policy is default deny, hence the requests to a route without
     * a defined set of rules are blocked.
     *
     * @param array $parameters
     * @param array $rules
     * @return ValidationResult
     * @throws \Exception
     */
    public static function validate($parameters, $rules): ValidationResult
    {
        // Default deny
        if (is_null($rules))
            return new ValidationResult(ValidationResult::ERR_UNPROTECTED_ROUTES);

        $rules = RulesParser::parse($rules);

        // Search for unexpected parameters
        $unexpectedParameters = static::checkForUnexpectedParameters(
            $parameters,
            array_keys($rules)
        );

        // There are some unexpected parameters
        if ($unexpectedParameters)
            return new ValidationResult(ValidationResult::ERR_UNEXPECTED_PARAMS);
        // The client has not sent parameters
        else if (count($parameters) === 0 && count($rules) > 0)
            return new ValidationResult(ValidationResult::ERR_NO_SENT_PARAMS);

        /**
         * @var array $rules
         * @var string $key
         * @var string|array $rule
         */
        foreach ($rules as $key => $rule) { // Validate each remaining parameter
            $content = static::accessValue($parameters, $key);

            // Check the validity of the rules
            if (!$rule($content))
                return new ValidationResult(
                    ValidationResult::ERR_VALIDATION,
                    array_pop(explode(".", $key))
                );
        }

        return new ValidationResult();
    }

    /**
     * Return the nested value in the array
     *
     * @param array $value
     * @param string $key
     * @return mixed
     */
    private static function accessValue(array $value, string $key)
    {
        $keys = explode(".", $key);
        foreach ($keys as $key)
            $value = $value[$key];

        return $value;
    }

    /**
     * Check if in the parameters exist unexpected elements
     *
     * @param mixed $parameters
     * @param array $expectedParameters
     * @param string $currentKey
     * @return bool
     */
    private static function checkForUnexpectedParameters($parameters, array $expectedParameters, string $currentKey = ""): bool
    {
        if (!is_array($parameters)) {
            return array_search($currentKey, $expectedParameters) === false;
        } else {
            $keysOfTheLevel = array_keys($parameters);
            $returnValue = false;
            foreach ($keysOfTheLevel as $key) {
                $returnValue = $returnValue || static::checkForUnexpectedParameters(
                    $parameters[$key],
                    $expectedParameters,
                    empty($currentKey) ? $key : $currentKey.".".$key
                );
            }

            return $returnValue;
        }
    }

}