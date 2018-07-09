<?php

namespace App\Components\Validation;

use App\Utils\{
    Pascalize,
    Snakize
};

/**
 * Class RulesUtils
 * @package App\components\validation
 */
class RulesUtils
{

    const CASE_SNAKE  = 0;
    const CASE_PASCAL = 1;

    /**
     * Return the available types of rules.
     *
     * @return array
     */
    public static function getTypesOfRules($case = self::CASE_SNAKE): array
    {
        $types = [];
        foreach (glob(__DIR__."/rules/*.php") as $file) {
            $matches = [];
            preg_match("/^.+\/(.+).php$/", $file, $matches);
            array_push(
                $types,
                $case === static::CASE_SNAKE ?
                    Snakize::transform($matches[1]) :
                    Pascalize::transform($matches[1])
            );
        }

        return $types;
    }


}