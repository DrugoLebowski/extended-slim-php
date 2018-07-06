<?php

namespace App\Components\Validation;

/**
 * The types that the parameters of the actions could take.
 *
 * Class FieldTypes
 * @package App\Components
 */
abstract class FieldTypes
{

    const INT       = 0;
    const FLOAT     = 1;
    const STRING    = 2;
    const BOOL      = 3;
    const TIMESTAMP = 4;
    const DATE      = 5;

}