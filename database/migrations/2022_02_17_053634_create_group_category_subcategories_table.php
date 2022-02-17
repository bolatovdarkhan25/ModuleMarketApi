<?php

use App\Domain\Contracts\Model\GroupCategoryContract;
use App\Domain\Contracts\Model\GroupCategorySubcategoryContract;
use App\Domain\Contracts\Model\SubcategoryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCategorySubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GroupCategorySubcategoryContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(GroupCategorySubcategoryContract::FIELD_ID);

            $table->foreignId(GroupCategorySubcategoryContract::FIELD_GROUP_CATEGORY_ID);
            $table->foreignId(GroupCategorySubcategoryContract::FIELD_SUBCATEGORY_ID);

            $table->unique([
                GroupCategorySubcategoryContract::FIELD_GROUP_CATEGORY_ID,
                GroupCategorySubcategoryContract::FIELD_SUBCATEGORY_ID
            ]);

            $table->foreign(GroupCategorySubcategoryContract::FIELD_GROUP_CATEGORY_ID)
                ->references(GroupCategoryContract::FIELD_ID)
                ->on(GroupCategoryContract::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign(GroupCategorySubcategoryContract::FIELD_SUBCATEGORY_ID)
                ->references(SubcategoryContract::FIELD_ID)
                ->on(SubcategoryContract::TABLE_NAME)
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_category_subcategories');
    }
}
