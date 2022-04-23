<?php

namespace Emtiazzahid\LaravelRat\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Console\OutputStyle;

class ConsoleCommand extends Command
{
    protected $name = 'NONEXISTENT';
    protected $hidden = true;

    public $outputSymfony;
    public $outputStyle;

    public function __construct($argInput = "")
    {
        parent::__construct();

        $this->input = new StringInput($argInput);

        $this->outputSymfony = new ConsoleOutput();
        $this->outputStyle = new OutputStyle($this->input, $this->outputSymfony);

        $this->output = $this->outputStyle;
    }

}
