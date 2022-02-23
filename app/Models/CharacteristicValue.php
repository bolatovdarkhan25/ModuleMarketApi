<?php

namespace App\Models;

use App\Domain\Contracts\Model\CharacteristicValueContract;
use Illuminate\Database\Eloquent\Model;

class CharacteristicValue extends Model
{
    protected $fillable = CharacteristicValueContract::FILLABLES_LIST;
}
