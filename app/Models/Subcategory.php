<?php

namespace App\Models;

use App\Domain\Contracts\Model\SubcategoryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = SubcategoryContract::FILLABLES_LIST;
}
