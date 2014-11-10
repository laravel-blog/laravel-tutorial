<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'authors', function ( Blueprint $oTable ) {
			$oTable->increments( 'id' );
			$oTable->string( 'name' );
			$oTable->string( 'country' );
			$oTable->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'authors' );
	}

}
