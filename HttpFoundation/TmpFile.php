<?php

namespace Ruvents\RuworkBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\File\File;

class TmpFile extends File
{
    public function __construct(string $contents = null)
    {
        $pathname = rtrim(sys_get_temp_dir(), '/\\').DIRECTORY_SEPARATOR.uniqid();

        if (null !== $contents) {
            file_put_contents($pathname, $contents);
        }

        parent::__construct($pathname);
    }

    public static function createFromResource(resource $handle): TmpFile
    {
        return new self(stream_get_contents($handle, -1, 0));
    }
}
