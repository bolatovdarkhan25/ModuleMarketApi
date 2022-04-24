<?php

use App\Domain\Contracts\Entity\CategoryContract;
use App\Domain\Contracts\Entity\GroupCategoryContract;
use App\Domain\Contracts\Entity\GroupContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GroupCategoryContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(GroupCategoryContract::FIELD_ID);

            $table->foreignId(GroupCategoryContract::FIELD_GROUP_ID);
            $table->foreignId(GroupCategoryContract::FIELD_CATEGORY_ID);

            $table->unique([GroupCategoryContract::FIELD_GROUP_ID, GroupCategoryContract::FIELD_CATEGORY_ID]);

            $table->foreign(GroupCategoryContract::FIELD_GROUP_ID)
                ->references(GroupContract::FIELD_ID)
                ->on(GroupContract::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign(GroupCategoryContract::FIELD_CATEGORY_ID)
                ->references(CategoryContract::FIELD_ID)
                ->on(CategoryContract::TABLE_NAME)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_categories');
    }
}
