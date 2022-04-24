<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\App;

class ContractMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name}
     {--m|model : Is this contract for model}
     {--table=  : Table name}';

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
        if (parent::handle() === false && !$this->option('force')) {
            return;
        }

        $isModel = $this->option('model');

        if ($isModel) {
            $this->info('Don\'t forget to assign to $fillable variable in model ' .
                'the FILLABLES_LIST const from brand new contract 😉');
        }
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        if ($this->option('model')) {
            return is_dir($this->laravel->basePath('app/Domain/Contracts/Entity'))
                ? $rootNamespace.'\\Domain\\Contracts\\Entity'
                : $rootNamespace;
        } else {
            return is_dir($this->laravel->basePath('app/Domain/Contracts'))
                ? $rootNamespace . '\\Domain\\Contracts'
                : $rootNamespace;
        }
    }

    protected function getStub(): string
    {
        if ($this->option('model')) {
            $stub = '/stubs/contract.model.stub';
        } else {
            $stub = '/stubs/contract.stub';
        }

        return App::basePath() . $stub;
    }

    protected function replaceClass($stub, $name): string
    {
        $tableName = (string) $this->option('table');

        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyInterface', '{{ table }}'], [$class, $tableName], $stub);
    }
}
