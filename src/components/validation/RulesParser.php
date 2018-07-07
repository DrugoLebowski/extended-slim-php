<?php

namespace App\Components\Validation;

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
    ];

    /**
     * Parse the data associated to a field and returns the rules
     *
     * @return array
     * @throws \Exception
     */
    public static function parse($data): array
    {
        if (!is_array($data)) throw new \Exception("Rules are not valid.");

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
        $type = null;
        $parsedRules = [];
        foreach ($rules as $rule) {
            $ruleParts = explode(":", $rule);

            $ruleType      = $ruleParts[0];
            $ruleParameter = null;
            if (!empty($ruleParts[1]))
                $ruleParameter = $ruleParts[1];

            if (array_search($ruleType, static::getTypesOfRules()) === false)
                throw new \Exception("It has been used an unknown rule.");

            $className = Pascalize::transform($ruleType);
            $class     = "\\App\\Components\\Validation\\Rules\\$className";
            array_push(
                $parsedRules,
                is_null($ruleParameter) ? new $class() : new $class($ruleParameter)
            );
        }

        return $parsedRules;
    }

    /**
     * Return the available types of rules.
     *
     * @return array
     */
    private static function getTypesOfRules(): array
    {
        $types = [];
        foreach (glob(__DIR__."/rules/*.php") as $file) {
            $matches = [];
            preg_match("/^.+\/(.+).php$/", $file, $matches);
            array_push(
                $types,
                Snakize::transform($matches[1])
            );
        }

        return $types;
    }

}