<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('computers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('mac');
			$table->string('ip')->nullable();
			$table->string('broadcast')->nullable();
			$table->string('subnet')->nullable();
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
		Schema::drop('computers');
	}

}
