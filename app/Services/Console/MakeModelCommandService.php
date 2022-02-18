<?php

namespace App\Services\Console;

use Illuminate\Support\Facades\App;

class MakeModelCommandService
{
    /**
     * @param bool|null $isTemp
     * @return void
     */
    public function relocateStubFiles(bool|null $isTemp)
    {
        $basePath = App::basePath();

        if ($isTemp) {
            if (!file_exists($basePath . '/stubs/migration.create.stub')) {
                copy($basePath . '/temp_stubs/migration.create.stub', $basePath . '/stubs/migration.create.stub');
            }
        } else {
            if (file_exists($basePath . '/stubs/migration.create.stub')) {
                unlink($basePath . '/stubs/migration.create.stub');
            }
        }
    }
}
