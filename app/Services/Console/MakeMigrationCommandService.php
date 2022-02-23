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
            case 'good':
                copy($basePath . '/temp_stubs/good.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'char':
                copy($basePath . '/temp_stubs/char.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'boosted':
                copy($basePath . '/temp_stubs/boosted.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'good_boosted':
                copy($basePath . '/temp_stubs/good.boosted.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'char_boosted':
                copy($basePath . '/temp_stubs/char.boosted.migration.stub',
                    $basePath . '/stubs/migration.create.stub');
                break;
            case 'common':
                unlink($basePath . '/stubs/migration.create.stub');
                break;
        }
    }
}
