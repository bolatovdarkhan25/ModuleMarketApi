<?php

use App\Domain\Contracts\Model\CharacteristicContract;
use App\Domain\Contracts\Model\GroupCategorySubcategoryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\Model\GroupCatSubCharacteristicContract;

class CreateGroupCatSubCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GroupCatSubCharacteristicContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(GroupCatSubCharacteristicContract::FIELD_ID);
            $table->foreignId(GroupCatSubCharacteristicContract::FIELD_GROUP_CATEGORY_SUBCATEGORY_ID);
            $table->foreignId(GroupCatSubCharacteristicContract::FIELD_CHARACTERISTIC_ID);
            $table->string(GroupCatSubCharacteristicContract::FIELD_METRICS)->nullable();

            $table->unique([
                GroupCatSubCharacteristicContract::FIELD_GROUP_CATEGORY_SUBCATEGORY_ID,
                GroupCatSubCharacteristicContract::FIELD_CHARACTERISTIC_ID
            ]);

            $table->foreign(GroupCatSubCharacteristicContract::FIELD_GROUP_CATEGORY_SUBCATEGORY_ID)
                ->references(GroupCategorySubcategoryContract::FIELD_ID)
                ->on(GroupCategorySubcategoryContract::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign(GroupCatSubCharacteristicContract::FIELD_CHARACTERISTIC_ID)
                ->references(CharacteristicContract::FIELD_ID)
                ->on(CharacteristicContract::TABLE_NAME)
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
        Schema::dropIfExists(GroupCatSubCharacteristicContract::TABLE_NAME);
    }
}
