<?php

namespace App\Components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;
use Carbon\Carbon;

/**
 * Class Date
 * @package App\Components\Validation\Rules
 */
class Date implements Rule
{

    /** @var string */
    private $format;

    /**
     * Date constructor.
     * @param string $format
     * @param string $date
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @param $content
     * @return bool
     */
    public function validate($content): bool
    {
        try {
            Carbon::createFromFormat($this->format, $content);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

}