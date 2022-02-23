<?php

namespace App\Models;

use App\Domain\Contracts\Model\CharacteristicContract;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $fillable = CharacteristicContract::FILLABLES_LIST;
}
