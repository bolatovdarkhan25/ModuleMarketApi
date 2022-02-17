<?php

use App\Domain\Contracts\Model\SubcategoryContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(SubcategoryContract::TABLE_NAME, function (Blueprint $table) {
            $table->id(SubcategoryContract::FIELD_ID);
            $table->string(SubcategoryContract::FIELD_NAME);
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
        Schema::dropIfExists('subcategories');
    }
}
