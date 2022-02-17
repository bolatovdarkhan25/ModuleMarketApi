<?php

namespace App\Models;

use App\Domain\Contracts\Model\SystemContract;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = SystemContract::FILLABLES_LIST;
}
