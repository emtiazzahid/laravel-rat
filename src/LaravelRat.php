<?php

namespace Emtiazzahid\LaravelRat;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

/**
 * @property $path
 * @property $height
 * @property $width
 */
class LaravelRat
{
    private $image;

    /**
     * @param $path
     * @param $height
     * @param $width
     * @return void
     */
    function run($path, $height, $width)
    {
        $this->path = $path;
        $this->height = $height;
        $this->width = $width;

        $this->scan();
    }

    /**
     * @return void
     */
    private function scan()
    {
        if (is_dir($this->path)) {
            $files = File::allFiles($this->path);
        } else {
            $files[] = File::get($this->path);
        }

        foreach ($files as $file) {
            if (in_array($file->getExtension(), $this->supportedExtensions())) {
                $this->resize($file);
            }
        }
    }


    private function resize($file)
    {
        $img = Image::make($file->getPathname())->resize($this->width, $this->height, function($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($file->getPathname());
    }

    private function supportedExtensions()
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'wbmp'];
    }
}
