<?php

namespace App\Models;

use App\Domain\Contracts\Model\GroupCategoryContract;
use App\Domain\Contracts\Model\GroupContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = GroupContract::FILLABLES_LIST;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            GroupCategoryContract::TABLE_NAME,
            GroupCategoryContract::FIELD_GROUP_ID,
            GroupCategoryContract::FIELD_CATEGORY_ID
        );
    }
}
