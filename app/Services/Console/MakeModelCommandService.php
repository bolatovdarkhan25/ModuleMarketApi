<?php

namespace App\Services\Console;

use Illuminate\Support\Facades\App;

class MakeModelCommandService
{
    /**
     * @param bool|null $isBoosted
     * @return void
     */
    public function relocateStubFiles(bool|null $isBoosted)
    {
        $basePath = App::basePath();

        if ($isBoosted) {
            copy($basePath . '/temp_stubs/model.stub', $basePath . '/stubs/model.stub');
            copy($basePath . '/temp_stubs/model.pivot.stub', $basePath . '/stubs/model.pivot.stub');
        } else {
            if (file_exists($basePath . '/stubs/model.stub')) {
                unlink($basePath . '/stubs/model.stub');
            }

            if (file_exists($basePath . '/stubs/model.pivot.stub')) {
                unlink($basePath . '/stubs/model.pivot.stub');
            }
        }
    }
}
