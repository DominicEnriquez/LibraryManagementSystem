<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_book', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrow_book_id')->unsigned();
            $table->decimal('charge', 5, 2)->default('0.00');
            $table->integer('total_late')->default(0);
            $table->date('return_at')->default('0000-00-00');
            $table->date('expired_at');
            $table->timestamps();
            
            $table->foreign('borrow_book_id')->references('id')->on('borrow_book');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('return_book');
    }
}
