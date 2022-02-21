<?php

namespace App\Services\Console;

use Illuminate\Support\Facades\App;

class MakeMigrationCommandService
{
    /**
     * @param bool|null $isTemp
     * @param bool|null $isBoosted
     * @return void
     */
    public function relocateStubFiles(bool|null $isTemp, bool|null $isBoosted)
    {
        $basePath = App::basePath();

        if ($isTemp) {
            copy($basePath . '/temp_stubs/temp_migration.stub', $basePath . '/stubs/migration.create.stub');
        }

        if ($isBoosted) {
            if ($isTemp) {
                copy($basePath . '/temp_stubs/temp_boosted_migration.stub', $basePath . '/stubs/migration.create.stub');
            } else {
                copy($basePath . '/temp_stubs/boosted_migration.stub', $basePath . '/stubs/migration.create.stub');
            }
        }

        if (!$isTemp && !$isBoosted && file_exists($basePath . '/stubs/migration.create.stub')) {
            unlink($basePath . '/stubs/migration.create.stub');
        }
    }
}
