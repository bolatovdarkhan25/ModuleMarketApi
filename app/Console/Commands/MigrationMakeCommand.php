<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use App\Services\Console\MigrationCreatorService as MigrationCreator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\App;

class MigrationMakeCommand extends MigrateMakeCommand
{
    /**
     * @var string
     */
    protected $signature = 'make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}
        {--contract= : The name of the related contract (works only for create)}
        {--temp : Is temporary (works only for create)}';

    public function __construct(Composer $composer)
    {
        $migrationCreator = new MigrationCreator(new Filesystem(), App::basePath() . '/stubs/migration.create.stub');

        parent::__construct($migrationCreator, $composer);
    }

    /**
     * @throws Exception
     */
    protected function writeMigration($name, $table, $create)
    {
        $contract = (string) $this->option('contract');
        $isTemp   = (bool) $this->option('temp');

        if ($isTemp && !$contract) {
            $stubType = 'temp';
        } elseif (!$isTemp && $contract) {
            $stubType = 'boosted';
        } elseif ($isTemp && $contract) {
            $stubType = 'temp_boosted';
        } else {
            $stubType = 'common';
        }

        $file = $this->creator->create($name, $this->getMigrationPath(), $table, $create, $stubType, $contract);

        if (! $this->option('fullpath')) {
            $file = pathinfo($file, PATHINFO_FILENAME);
        }

        $this->line("<info>Created Migration:</info> {$file}");
    }
}
