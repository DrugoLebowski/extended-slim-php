<?php

namespace App\Components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Class MediaMaxSize
 * @package App\Components\Validation\Rules
 */
class MediaMaxSize implements Rule
{

    /** @var int */
    private $size;

    /**
     * MediaMaxSize constructor.
     * @param $size
     */
    public function __construct($size)
    {
        $this->size = (int) $size;
    }

    /**
     * @param UploadedFileInterface $file
     * @return bool
     */
    function validate($file): bool
    {
        return $file->getSize() ?? 0 <= $this->size;
    }

}