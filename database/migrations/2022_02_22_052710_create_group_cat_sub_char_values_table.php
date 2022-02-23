<?php

use App\Domain\Contracts\Model\CharacteristicValueContract;
use App\Domain\Contracts\Model\GroupCatSubCharacteristicContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\Model\GroupCatSubCharValueContract;

class CreateGroupCatSubCharValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GroupCatSubCharValueContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(GroupCatSubCharValueContract::FIELD_ID);

            $table->foreignId(GroupCatSubCharValueContract::FIELD_GROUP_CAT_SUB_CHAR_ID);
            $table->foreignId(GroupCatSubCharValueContract::FIELD_CHARACTERISTIC_VALUE_ID);

            $table->unique([
                GroupCatSubCharValueContract::FIELD_GROUP_CAT_SUB_CHAR_ID,
                GroupCatSubCharValueContract::FIELD_CHARACTERISTIC_VALUE_ID
            ]);

            $table->foreign(GroupCatSubCharValueContract::FIELD_GROUP_CAT_SUB_CHAR_ID)
                ->references(GroupCatSubCharacteristicContract::FIELD_ID)
                ->on(GroupCatSubCharacteristicContract::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign(GroupCatSubCharValueContract::FIELD_CHARACTERISTIC_VALUE_ID)
                ->references(CharacteristicValueContract::FIELD_ID)
                ->on(CharacteristicValueContract::TABLE_NAME)
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
        Schema::dropIfExists(GroupCatSubCharValueContract::TABLE_NAME);
    }
}
