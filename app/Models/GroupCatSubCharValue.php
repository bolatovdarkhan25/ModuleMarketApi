<?php

namespace App\Models;

use App\Domain\Contracts\Model\GroupCatSubCharValueContract;
use Illuminate\Database\Eloquent\Model;

class GroupCatSubCharValue extends Model
{
    protected $fillable = GroupCatSubCharValueContract::FILLABLES_LIST;
}
