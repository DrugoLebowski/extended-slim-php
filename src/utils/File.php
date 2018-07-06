<?php

namespace App\Utils;

use \Psr\Http\Message\UploadedFileInterface;

class File
{

    /**
     * Move the file to the indicated path, returning the new filename.
     *
     * @param string $path
     * @param UploadedFileInterface $file
     * @return string
     * @throws \Exception
     */
    public static function move(string $path, UploadedFileInterface $file): string
    {
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $file->moveTo($path . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    /**
     * Remove recursively a directory.
     *
     * @param string $path
     */
    public static function remove(string $path): string
    {
        foreach(glob($path . '/*') as $file)
            is_dir($file) ?
                self::remove($file) :
                unlink($file);

        rmdir($path);
    }

}