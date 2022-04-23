<?php

namespace Emtiazzahid\LaravelRat;

use Emtiazzahid\LaravelRat\Console\ConsoleCommand;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;


class LaravelRat
{
    private $cmd;

    public function __construct()
    {
        $this->cmd = new ConsoleCommand();
    }

    /**
     * @param $path
     * @param $height
     * @param $width
     * @return void
     */
    function run($path, $allDir, $height, $width)
    {
        $this->scan($path, $allDir, $height, $width);
    }

    /**
     * @return void
     */
    private function scan($path, $allDir, $height, $width)
    {
        if (is_dir($path)) {
            if ($allDir) {
                $files = File::allFiles($path);
            } else {
                $files = File::files($path);
            }
        } else {
            $files[] = File::get($path);
        }

        $totalFiles = count($files);

        $this->cmd->outputStyle->writeln('Rat found total ' . $totalFiles . ' file');

        $this->cmd->outputStyle->progressStart($totalFiles);

        foreach ($files as $file) {
            $this->cmd->outputStyle->progressAdvance();

            if (in_array($file->getExtension(), $this->supportedExtensions())) {
                $this->resize($file, $height, $width);
            } else {
                $this->cmd->outputStyle->writeln(sprintf(' | File %s skipping! extension: %s',$file->getFilename(), $file->getExtension()));
            }

            sleep(1);
        }

        $this->cmd->outputStyle->progressFinish();
    }


    private function resize($file, $height, $width)
    {
        $img = Image::make($file->getPathname())->resize($width, $height, function($constraint) {
            $constraint->aspectRatio();
        })->save($file->getPathname());

        $this->cmd->outputStyle->writeln(sprintf(' | File %s Size: %s KB => %s KB', $file->getFilename(), $file->getSize(), $img->filesize()));
    }

    /**
     * @return string[]
     */
    private function supportedExtensions()
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'wbmp'];
    }
}
