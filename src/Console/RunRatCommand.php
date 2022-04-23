<?php

namespace Emtiazzahid\LaravelRat\Console;

use Emtiazzahid\LaravelRat\LaravelRat;
use Illuminate\Console\Command;

class RunRatCommand extends Command
{
    protected $laravelRat = false;

    protected $signature = 'rat:run';

    protected $description = 'Command your rat to run for images resize';

    public function __construct(LaravelRat $laravelRat)
    {
        parent::__construct();

        $this->laravelRat = $laravelRat;
    }

    public function handle()
    {
        $path = $this->ask('Folder/File path (from root path. ex: public/images)', 'public');
        $allDir = $this->ask('Scan only that path or subdirectories also? (true/false)', true);

        $height = $this->ask('Height (px)', false);
        $width = $this->ask('Width (px)', false);

        $this->info('Rat going inside ... ' . $path);
        try {
            $this->laravelRat->run($path, $allDir, $height, $width);
        } catch (\Exception $exception) {
            $this->error(' | ' . $exception->getMessage());
        }

        $this->info('Rat came back home');
    }
}
