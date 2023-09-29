<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function   ( Blueprint $table ) {
			$table->increments('id');
			$table->string('name');
			$table->decimal('price', 8, 2);
			$table->string('img');
			$table->integer('quantity');
			$table->string('isExist');
			$table->decimal('time', 8, 2);
			$table->string('product');
			
	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            //
        });
    }
}
