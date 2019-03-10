<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('sub_category_name');
            $table->text('description');
            $table->string('created_by');
            $table->string('category_image');
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->foreign('category_name')->references('name')->on('category');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_category');
    }
}
