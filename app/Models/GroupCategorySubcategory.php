<?php

namespace App\Models;

use App\Domain\Contracts\Model\GroupCategorySubcategoryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCategorySubcategory extends Model
{
    use HasFactory;

    protected $fillable = GroupCategorySubcategoryContract::FILLABLES_LIST;
}
