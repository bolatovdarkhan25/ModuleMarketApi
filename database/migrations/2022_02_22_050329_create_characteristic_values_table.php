<?php

use App\Domain\Contracts\Model\CharacteristicContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\Model\CharacteristicValueContract;

class CreateCharacteristicValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CharacteristicValueContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(CharacteristicValueContract::FIELD_ID);
            $table->string(CharacteristicValueContract::FIELD_VALUE); // TODO как быть с типами данных?
            $table->foreignId(CharacteristicValueContract::FIELD_CHARACTERISTIC_ID);
            $table->foreign(CharacteristicValueContract::FIELD_CHARACTERISTIC_ID)
                ->references(CharacteristicContract::FIELD_ID)
                ->on(CharacteristicContract::TABLE_NAME)
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
        Schema::dropIfExists(CharacteristicValueContract::TABLE_NAME);
    }
}
