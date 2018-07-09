<?php

namespace App\Components\Validation;

use App\Components\Validation\Exceptions\UnrecognizedRuleException;
use App\Components\Validation\Interfaces\Rule;
use App\Utils\Pascalize;

/**
 * Class RulesFactory
 * @package App\Components\Validation
 */
class RulesFactory
{

    /**
     * @param string $class
     * @param $ruleData
     * @return Rule
     * @throws \Exception
     */
    public static function create(string $class, $ruleData = null)
    {
        $typesOfRules = RulesUtils::getTypesOfRules();
        if (array_search($class, $typesOfRules) === false)
            throw new UnrecognizedRuleException("The rule of the type $class does not exist.");

        $class = Pascalize::transform($class);
        $namespace = "\\App\\Components\\Validation\\Rules\\$class";
        return is_null($ruleData) ?
            new $namespace() :
            new $namespace($ruleData);
    }

}