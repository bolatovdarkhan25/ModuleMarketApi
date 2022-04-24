<?php

namespace App\Models;

use App\Domain\Contracts\Entity\CategoryContract;
use App\Domain\Contracts\Entity\GroupCategoryContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements CategoryContract
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
