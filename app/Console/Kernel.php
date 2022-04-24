<?php

namespace App\Console;

use App\Console\Commands\ContractMakeCommand;
use App\Console\Commands\MigrationMakeCommand;
use App\Console\Commands\ModelMakeCommand;
use App\Console\Commands\RepositoryMakeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ModelMakeCommand::class,
        ContractMakeCommand::class,
        RepositoryMakeCommand::class,
        MigrationMakeCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
