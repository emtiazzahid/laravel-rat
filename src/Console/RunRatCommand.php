<?php

namespace Emtiazzahid\LaravelRat\Console;

use Emtiazzahid\LaravelRat\LaravelRat;
use Illuminate\Console\Command;

class RunRatCommand extends Command
{
    protected $path = null;
    protected $height = false;
    protected $width = false;
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
        $this->path = $this->ask('Folder/File path (from root path. ex: public/images)');

        $this->height = $this->ask('Height', false);
        $this->width = $this->ask('Width', false);

        $this->info('Rat going for ... ' . $this->path);
        try {
            $this->laravelRat->run($this->path, $this->height, $this->width);
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
