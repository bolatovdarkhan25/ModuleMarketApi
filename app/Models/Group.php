<?php

namespace App\Models;

use App\Domain\Contracts\Model\GroupContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = GroupContract::FILLABLES_LIST;
}
