<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id'); 

			//PEOPLE DATA
			$table->char('cpf', 11)->unique()->nullable();
			$table->string('name', 50);
			$table->char('phone', 11);
			$table->date('birth')->nullable();
			$table->char('gender', 1)->nullable();
			$table->text('notes')->nullable();

			//auth data
			$table->string('email', 80)->unique();
			$table->string('password', 254)->nullable();

			//Permission
			$table->string('status')->default('active');
			$table->string('permisssion')->default('app.user');

			//$table->remenberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Aqui vc passa o codigo para fazer a delecao de uma tabela 
		//e podemos apgar para inserir um relacionamento nela
		Schema::table('users', function(Blueprint $table){

		});
		
		Schema::drop('users');
	}
}
