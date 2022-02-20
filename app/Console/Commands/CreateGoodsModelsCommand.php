<?php

namespace App\Console\Commands;

use App\Domain\Contracts\Model\GroupContract;
use App\Domain\Repositories\GroupRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateGoodsModelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-goods-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates migration for goods by groups';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle(GroupRepository $groupRepository)
    {
        if (config('app.env') === 'local') {
            DB::beginTransaction();

            try {
                $data     = collect(GroupContract::SEEDER_DATA);
                $prefixes = $data->keys()->toArray();

                $existedPrefixes = $groupRepository->findAllByColumnInValues(
                    GroupContract::FIELD_PREFIX,
                    $prefixes,
                    [GroupContract::FIELD_PREFIX]
                )->pluck(GroupContract::FIELD_PREFIX);

                $filteredData = $data->except($existedPrefixes);

                foreach ($filteredData as $prefix => $name) {
                    $groupRepository->create([
                        GroupContract::FIELD_PREFIX => $prefix,
                        GroupContract::FIELD_NAME   => $name
                    ]);

                    $modelName = ucfirst($prefix) . 'Good';
                    $this->call("make:model $modelName -tmb");
                }

                DB::commit();
            } catch (Throwable $exception) {
                DB::rollBack();

                Log::error($exception->getMessage(), ['trace' => $exception->getTrace()]);

                $this->error('Ошибка');
            }
        } else {
            return 0;
        }
    }
}
