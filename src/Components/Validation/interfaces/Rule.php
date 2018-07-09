<?php

namespace App\Components\Validation\Interfaces;

/**
 * Interface Rule
 * @package App\components\Validation\Interfaces
 */
interface Rule
{
    function validate($content): bool;
}