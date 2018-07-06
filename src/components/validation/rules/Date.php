<?php

namespace App\Components\Validation\Rules;

use Carbon\Carbon;

/**
 * Class Date
 * @package App\Components\Validation\Rules
 */
class Date
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

    public function __invoke($content)
    {
        try {
            Carbon::createFromFormat($this->format, $content);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

}