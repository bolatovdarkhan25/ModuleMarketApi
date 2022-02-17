<?php

use App\Domain\Contracts\Model\GroupContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(GroupContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(GroupContract::FIELD_ID);
            $table->string(GroupContract::FIELD_NAME);
            $table->string(GroupContract::FIELD_PREFIX)->unique();
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
        Schema::dropIfExists('groups');
    }
}
