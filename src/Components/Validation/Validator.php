<?php

namespace App\Components\Validation;

use App\components\Validation\Interfaces\Rule;

/**
 * Class Validator
 * @package App\Components\Validation
 */
class Validator
{
    /**
     * Rules that can be applied only to files.
     *
     * @var array FILE_RULES
     */
    const FILE_RULES = [
        "media_type",
    ];

    /**
     * Rules that can be applied to normal data (i.e. data that is not a file)
     *
     * @var array NORMAL_TYPE_RULES
     */
    const NORMAL_TYPE_RULES = [
        "date",
        "equal",
        "equal_length",
        "greater",
        "greater_equal",
        "lower",
        "lower_equal",
        "max_length",
        "min_length",
        "not_regex",
        "regex",
        "required",
    ];

    /**
     * Validate the passed parameters and prune the unexpected parameters.
     * The used policy is default deny, hence the requests to a route without
     * a defined set of rules are blocked.
     *
     * @param array $parameters
     * @param array $rules
     * @param string $policy
     * @return ValidationResult
     * @throws \Exception
     */
    public static function validate($parameters, $rules, $policy = "default_deny"): ValidationResult
    {
        if (is_null($rules))
            if ($policy === "default_accept")
                return new ValidationResult();
            else if ($policy === "default_deny")
                return new ValidationResult(ValidationResult::ERR_UNPROTECTED_ROUTES);
            else
                throw new \Exception("Unrecognized validation policy.");

        // Parse the current set of rules
        $rules = RulesParser::parse($rules);

        // Search for unexpected parameters
        $unexpectedParameters = static::checkForUnexpectedParameters(
            $parameters,
            array_keys($rules)
        );

        // TODO: Check if the rules are compatible with the associated data
        $incompatibleRulesWithData = false;

        // There are some unexpected parameters
        if ($unexpectedParameters)
            return new ValidationResult(ValidationResult::ERR_UNEXPECTED_PARAMS);
        else if ($incompatibleRulesWithData)
            return new ValidationResult(ValidationResult::ERR_INCOMPATIBLE_RULES_DATA);
        // The client has not sent parameters
        else if (count($parameters) === 0 && count($rules) > 0)
            return new ValidationResult(ValidationResult::ERR_NO_SENT_PARAMS);

        /**
         * @var array $rules
         * @var string $key
         * @var Rule $rule
         */
        foreach ($rules as $key => $rule) { // Validate each remaining parameter
            $content = static::accessValue($parameters, $key);

            // Check the validity of the rules
            $keyParts = explode(".", $key);
            $key = array_pop($keyParts);
            if (!$rule->validate($content))
                return new ValidationResult(
                    ValidationResult::ERR_VALIDATION,
                    $key
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