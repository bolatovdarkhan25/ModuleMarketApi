<?php

namespace App\Services\Console;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Facades\App;

class MigrationCreatorService extends MigrationCreator
{
    public function create($name, $path, $table = null, $create = false, string $stubType = '', string $contract = ''): string
    {
        $this->ensureMigrationDoesntAlreadyExist($name, $path);

        $stub = $this->getStub($table, $create, $stubType);

        $path = $this->getPath($name, $path);

        $this->files->ensureDirectoryExists(dirname($path));

        $this->files->put(
            $path, $this->populateStub($name, $stub, $table, $stubType, $contract)
        );

        $this->firePostCreateHooks($table);

        return $path;
    }

    protected function populateStub($name, $stub, $table, string $stubType = '', string $contract = ''): string
    {
        $stub = str_replace(
            ['DummyClass', '{{ class }}', '{{class}}'],
            $this->getClassName($name), $stub
        );

        if ($stubType === 'common' || $stubType === 'temp') {
            if (! is_null($table)) {
                $stub = str_replace(
                    ['DummyTable', '{{ table }}', '{{table}}'],
                    $table, $stub
                );
            }
        } else {
            if (! is_null($table)) {
                $stub = str_replace(
                    ['{{ contract }}', '{{contract}}'],
                    $contract, $stub
                );
            }
        }

        return $stub;
    }

    public function stubPath(): string
    {
        $appStubPath = App::basePath() . '/stubs';
        $libStubPath = App::basePath() . '/vendor/illuminate/database/Migrations/stubs';

        return file_exists($appStubPath . '/migration.create.stub') ? $appStubPath : $libStubPath;
    }

    protected function getStub($table, $create, string $stubType = '')
    {
        $makeMigrationService = new MakeMigrationCommandService();

        $isTemp  = false;
        $boosted = false;

        if ($stubType === 'temp' || $stubType === 'temp_boosted') {
            $isTemp = true;
        }

        if ($stubType === 'temp_boosted' || $stubType === 'boosted') {
            $boosted = true;
        }

        $makeMigrationService->relocateStubFiles($isTemp, $boosted);

        return parent::getStub($table, $create);
    }
}
