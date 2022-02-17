<?php

use App\Domain\Contracts\Model\SystemContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SystemContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(SystemContract::FIELD_ID);
            $table->string(SystemContract::FIELD_NAME);
            $table->string(SystemContract::FIELD_DESCRIPTION);
            $table->string(SystemContract::FIELD_API_TOKEN);
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
        Schema::dropIfExists('systems');
    }
}
