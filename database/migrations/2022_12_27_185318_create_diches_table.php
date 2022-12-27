<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diches', function (Blueprint $table) {
            $table->id('id_diches');
            $table->unsignedBigInteger('id_category');
            $table->string('name');
            $table->string('image');
            $table->float('price');
            $table->float('count');
            $table->foreign('id_category', 'diches_id_category_fkey')->references('id_category')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('diches', function (Blueprint $table) {
            $table->dropForeign('diches_id_category_fkey');
            $table->dropColumn('id_category');
        });
        Schema::dropIfExists('diches');
    }
};
