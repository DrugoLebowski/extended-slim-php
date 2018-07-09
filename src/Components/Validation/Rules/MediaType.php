<?php

namespace App\Components\Validation\Rules;

use App\Components\Validation\Interfaces\Rule;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Class MediaType
 * @package App\Components\Validation\Rules
 */
class MediaType implements Rule
{

    /** @var string $contentTypes */
    private $contentTypes;

    public function __construct($rule)
    {
        $this->contentTypes = explode(",", $rule);
    }

    /**
     * @param UploadedFileInterface $file
     * @return bool
     */
    public function validate($file): bool
    {
        return array_search(
            $file->getClientMediaType(),
            $this->contentTypes
        ) !== false;
    }

}