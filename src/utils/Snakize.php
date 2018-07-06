<?php

namespace App\Utils;

/**
 * Class Snakize
 * @package App\Components
 */
class Snakize
{

    /**
     * Return the string formatted with snake case.
     *
     * @param $input
     * @return string
     */
    public static function transform($input)
    {
        preg_match_all(
            '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!',
            $input,
            $matches
        );
        $ret = $matches[0];

        foreach ($ret as &$match)
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);

        return implode('_', $ret);
    }

}