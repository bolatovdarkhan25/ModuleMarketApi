<?php

namespace App\Console\Commands;

use App\Services\Console\MakeModelCommandService;
use Flipbox\LumenGenerator\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

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

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('seed', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('boost', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('seed')) {
            $this->createSeeder();
        }

        if ($this->option('controller') || $this->option('resource') || $this->option('api')) {
            $this->createController();
        }

        if ($this->option('boost')) {
            $this->createContract();
            $this->createRepository();
        }
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $args = ['name' => "create_{$table}_table", '--create' => $table];

        if ($this->option('boost')) {
            $args['--contract'] = Str::studly(class_basename($this->argument('name'))) . 'Contract';
        }

        if ($this->option('temp')) {
            $args['--temp'] = true;
        }

        $this->call('make:migration', $args);
    }

    /**
     * Create a seeder file for the model.
     *
     * @return void
     */
    protected function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('make:seed', [
            'name' => "{$seeder}Seeder",
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', array_filter([
            'name'  => "{$controller}Controller",
            '--model' => $this->option('resource') || $this->option('api') ? $modelName : null,
            '--api' => $this->option('api'),
        ]));
    }

    /**
     * @return void
     */
    private function createContract()
    {
        $contractName = Str::studly(class_basename($this->argument('name'))) . 'Contract';

        $args = ['name' => $contractName, '-m' => true];

        if ($this->option('temp')) {
            $args['-t'] = true;
        }

        $this->call("make:contract", $args);
    }

    /**
     * @return void
     */
    private function createRepository()
    {
        $modelName      = Str::studly(class_basename($this->argument('name')));
        $repositoryName = $modelName . 'Repository';

        $this->call("make:repository", [
            'name'    => $repositoryName,
            '--model' => $modelName
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        $stub = $this->option('pivot')
            ? '/stubs/model.pivot.stub'
            : '/stubs/model.stub';

        $isBoosted = $this->option('boost');

        $service = new MakeModelCommandService();

        $service->relocateStubFiles($isBoosted);

        if ($isBoosted) {
            return App::basePath() . $stub;
        } else {
            return 'vendor/flipbox/lumen-generator/src/LumenGenerator/Console' . $stub;
        }

    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return is_dir($this->laravel->basePath('app/Models'))
            ? $rootNamespace.'\\Models'
            : $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, resource controller, contract and repository for the model'],
            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],
            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists'],
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model'],
            ['seed', 's', InputOption::VALUE_NONE, 'Create a new seeder file for the model'],
            ['boost', 'b', InputOption::VALUE_NONE, 'Create a new contract and repository file for the model'],
            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
            ['api', null, InputOption::VALUE_NONE, 'Indicates if the generated controller should be an API controller'],
            ['temp', 't', InputOption::VALUE_NONE, 'Don\'t use this manually!'], // TODO temporary
        ];
    }
}
