<?php

namespace App\Models;

use App\Domain\Contracts\Model\CategoryContract;
use App\Domain\Contracts\Model\GroupCategoryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = CategoryContract::FILLABLES_LIST;

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            GroupCategoryContract::TABLE_NAME,
            GroupCategoryContract::FIELD_CATEGORY_ID,
            GroupCategoryContract::FIELD_GROUP_ID
        );
    }
}
