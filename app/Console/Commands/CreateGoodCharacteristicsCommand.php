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
     * @param CharacteristicRepository $characteristicRepository
     * @return int
     * @throws Throwable
     */
    public function handle(
        CreateGoodCharacteristicsCommandService $service,
        CharacteristicRepository $characteristicRepository
    ): int {
        $data = collect(CharacteristicContract::SEEDER_DATA);
        $prefixes = $data->keys()->toArray();
        $prefixesAndDataTypes = $characteristicRepository->findAllByColumnInValues(
            CharacteristicContract::FIELD_PREFIX,
            $prefixes,
            [CharacteristicContract::FIELD_PREFIX, CharacteristicContract::FIELD_DATA_TYPE]
        );

        DB::beginTransaction();

        try {
            foreach ($prefixesAndDataTypes as $prefix => $dataType) {
                $modelName = $service->convertPrefixToModelName(Str::singular($prefix));
                $this->call('make:model', [
                    'name'        => $modelName,
                    '--type'      => 'char',
                    '--data_type' => $dataType,
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
