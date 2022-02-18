<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ContractMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates contract interface';

    /**
     * @var string
     */
    protected $type = 'Contract';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        $name = $this->getNameInput();

//        $isModel = $this->input->getOption('model');

        dd($name);
    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
