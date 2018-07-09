<?php

namespace App\Components\Validation;

use App\Components\Validation\Exceptions\UnrecognizedRuleException;
use App\Components\Validation\Interfaces\Rule;
use App\Utils\Snakize;
use App\Utils\Pascalize;

/**
 * Class RulesParser
 * @package App\Components\Validation
 */
class RulesParser
{

    /** @var array */
    private const FIELD_TYPES = [
        "array",
        "int",
        "float",
        "string",
        "timestamp",
        "date",
        "bool",
        "file",
    ];

    /**
     * Parse the data associated to a field and returns the rules
     *
     * @return array
     * @throws \Exception
     */
    public static function parse($data): array
    {
        if (!is_array($data))
            throw new \Exception("Rules are not valid.");

        $rules = [];
        foreach ($data as $field => $fieldRules) {
            // This require that the first element must be the field type
            $rulesIsAString = is_string($fieldRules);
            if ($rulesIsAString) $fieldRules = explode("||", $fieldRules);

            $fieldType = array_shift($fieldRules);
            if (array_search($fieldType, static::FIELD_TYPES) === false)
                throw new \Exception("The type of the field {$field} is not valid.");

            // Create the rule
            $rules[$field] = new Rules(
                $fieldType,
                static::parseFieldRules($rulesIsAString ? explode("|", $fieldRules[0]) : $fieldRules)
            );
        }

        return $rules;
    }

    /**
     * Parse the rules associated to a field.
     *
     * @param $rules
     * @return array
     * @throws \Exception
     */
    private static function parseFieldRules($rules): array
    {
        $parsedRules = [];
        foreach ($rules as $rule) {
            // The rule is an object defined by the user.
            if (is_callable($rule)) {
                array_push(
                    $parsedRules,
                    $rule
                );
            } else if (is_object($rule)) {
                if (! $rule instanceof Rule)
                    throw new UnrecognizedRuleException("The object must implements the Rule interface.");

                array_push(
                    $parsedRules,
                    $rule
                );
            } else {
                $ruleParts = explode(":", $rule);

                $ruleType = array_shift($ruleParts);
                if (array_search($ruleType, RulesUtils::getTypesOfRules()) === false)
                    throw new UnrecognizedRuleException("It has been used an unknown rule.");

                array_push(
                    $parsedRules,
                    RulesFactory::create($ruleType, array_shift($ruleParts))
                );
            }
        }

        return $parsedRules;
    }

}