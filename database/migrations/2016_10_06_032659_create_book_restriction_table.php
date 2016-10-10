<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookRestrictionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_restriction', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('max_duration');
            $table->tinyInteger('max_loan');
            $table->tinyInteger('junior_max_loan');
            $table->decimal('charge_expired', 5, 2)->default('0.00');
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
        Schema::drop('book_restriction');
    }
}
