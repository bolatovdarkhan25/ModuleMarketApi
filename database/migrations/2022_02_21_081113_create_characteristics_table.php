<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\Model\CharacteristicContract;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CharacteristicContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(CharacteristicContract::FIELD_ID);
            $table->string(CharacteristicContract::FIELD_PREFIX)->unique();
            $table->string(CharacteristicContract::FIELD_NAME);
            $table->string(CharacteristicContract::FIELD_DATA_TYPE);
            $table->boolean(CharacteristicContract::FIELD_COMMON)->default(false);
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
        Schema::dropIfExists(CharacteristicContract::TABLE_NAME);
    }
}
