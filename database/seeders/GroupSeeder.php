<?php

namespace Database\Seeders;

use App\Domain\Contracts\Model\GroupContract;
use App\Domain\Repositories\GroupRepository;
use App\Models\System;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(GroupRepository $groupRepository)
    {
        $data = GroupContract::SEEDER_DATA;

        foreach ($data as $prefix => $name) {
            $groupRepository->create([
                GroupContract::FIELD_PREFIX => $prefix,
                GroupContract::FIELD_NAME   => $name
            ]);
        }
    }
}
