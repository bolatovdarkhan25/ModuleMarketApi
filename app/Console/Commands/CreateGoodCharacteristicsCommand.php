<?php

namespace App\Console\Commands;

use App\Domain\Contracts\Model\CharacteristicContract;
use App\Domain\Repositories\CharacteristicRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
     * @param CharacteristicRepository $characteristicRepository
     * @return int
     * @throws Throwable
     */
    public function handle(CharacteristicRepository $characteristicRepository): int
    {
        $data = collect(CharacteristicContract::SEEDER_DATA);

        $prefixes = $data->keys()->toArray();

        $existedPrefixes = $characteristicRepository->findAllByColumnInValues(
            CharacteristicContract::FIELD_PREFIX,
            $prefixes,
            [CharacteristicContract::FIELD_PREFIX]
        )->pluck(CharacteristicContract::FIELD_PREFIX);

        $filteredData = $data->except($existedPrefixes);

        DB::beginTransaction();

        try {
            foreach ($filteredData as $prefix => $name) {
                $characteristicRepository->create([
                    CharacteristicContract::FIELD_PREFIX => $prefix,
                    CharacteristicContract::FIELD_NAME   => $name
                ]);

                $this->call('make:model', [
                    'name'        => 'Good' . ucfirst($prefix),
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
