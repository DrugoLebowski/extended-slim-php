<?php

namespace App\Utils;

/**
 * Class Pascalize
 * @package App\utils
 */
class Pascalize
{

    /**
     * Return the string formatted with snake case.
     *
     * @param string $value
     * @return string
     */
    public static function transform(string $value): string
    {
        return array_reduce(
            array_map(
                function ($part) {
                    return ucfirst($part);
                },
                explode("_", $value)
            ),
            function ($r, $v) {
                return $r.$v;
            },
            ""
        );
    }

}