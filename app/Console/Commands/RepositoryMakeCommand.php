<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\App;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model= : Name of the model which refers to this repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a repository for the model';

    /**
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $modelName = $this->option('model');
        if (!$modelName) {
            $this->error('You have to specify the related model in --model flag');
            return;
        } else {
            if (!file_exists(App::basePath() . '/app/Models/' . $modelName . '.php')) {
                $this->error('Model not exists');
                return;
            }
        }

        if (parent::handle() === false && !$this->option('force')) {
            return;
        }
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return is_dir($this->laravel->basePath('app/Domain/Repositories'))
            ? $rootNamespace.'\\Domain\\Repositories'
            : $rootNamespace;
    }

    protected function getStub(): string
    {
        return App::basePath() . '/stubs/repository.stub';
    }

    protected function replaceClass($stub, $name): string
    {
        $repository = str_replace($this->getNamespace($name).'\\', '', $name);
        $model      = $this->option('model');

        return str_replace(['{{repository}}', '{{model}}'], [$repository, $model], $stub);
    }
}
