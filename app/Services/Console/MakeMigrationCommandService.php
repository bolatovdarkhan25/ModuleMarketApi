<?php

namespace App\Services\Console;

use Illuminate\Support\Facades\App;

class MakeMigrationCommandService
{
    /**
     * @param string $stubType
     * @return void
     */
    public function relocateStubFiles(string $stubType)
    {
        $basePath = App::basePath();

        switch ($stubType) {
            case 'boosted':
                copy($basePath . '/temp_stubs/boosted.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'common':
                unlink($basePath . '/stubs/migration.create.stub');
                break;
        }
    }
}
