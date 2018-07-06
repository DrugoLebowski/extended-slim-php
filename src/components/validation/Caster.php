<?php

namespace App\Components\Validation;

class Caster
{

    /**
     * Cast the parameters in base of the types specified in the validation rules.
     *
     * @param array $parameters
     * @param array $rules
     * @return array
     * @throws \Exception
     */
    public static function cast(array $parameters, array $rules): array
    {
        $rules = RulesParser::parse($rules);

        $castedParameters = [];
        foreach ($parameters as $key => $parameter) {
            /** @var Rules $rule */
            $rule = $rules[$key];
            switch($rule->getType()) {
                case FieldTypes::INT:
                case FieldTypes::TIMESTAMP:
                    $castedParameters[$key] = (int) $parameter;
                    break;
                case FieldTypes::FLOAT:
                    $castedParameters[$key] = (float) str_replace(",", ".", $parameter);
                    break;
                case FieldTypes::STRING:
                case FieldTypes::DATE:
                    $castedParameters[$key] = (string) $parameter;
                    break;
                case FieldTypes::BOOL:
                    $castedParameters[$key] = filter_var($parameter, FILTER_VALIDATE_BOOLEAN);
                    break;
                default:
            }
        }

        return $castedParameters;
    }

}