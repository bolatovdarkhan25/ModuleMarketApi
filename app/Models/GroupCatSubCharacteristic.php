<?php

namespace App\Models;

use App\Domain\Contracts\Model\GroupCatSubCharacteristicContract;
use Illuminate\Database\Eloquent\Model;

class GroupCatSubCharacteristic extends Model
{
    protected $table = GroupCatSubCharacteristicContract::TABLE_NAME;

    protected $fillable = GroupCatSubCharacteristicContract::FILLABLES_LIST;
}
