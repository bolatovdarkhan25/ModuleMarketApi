<?php

namespace App\Console\Commands;

use App\Domain\Contracts\Model\CharacteristicContract;
use App\Domain\Repositories\CharacteristicRepository;
use App\Services\Console\CreateGoodCharacteristicsCommandService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class CreateGoodCharacteristicsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-good-characteristics-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates migration to relate characteristics with goods';

    /**
     * Execute the console command.
     *
     * @param CreateGoodCharacteristicsCommandService $service
     * @return int
     * @throws Throwable
     */
    public function handle(CreateGoodCharacteristicsCommandService $service): int
    {
        $data = collect(CharacteristicContract::SEEDER_DATA);

        DB::beginTransaction();

        try {
            foreach ($data as $prefix => $name) {
                $modelName = $service->convertPrefixToModelName(Str::singular($prefix));
                $this->call('make:model', [
                    'name'        => $modelName,
                    '--type'      => 'char',
                    '--migration' => true,
                    '--boost'     => true
                ]);
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw new $exception;
        }

        return 1;
    }
}
