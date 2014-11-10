<?php

/**
 * @created 07.11.14 - 14:15
 * @author stefanriedel
 */
class BookTest extends TestCase {
	public function testHasAuthor() {

		$oRelease = new \Carbon\Carbon();
		$oRelease->setDate( 2014, 01, 01 );

		$oBook = new Book( [
			'name'         => 'Laravel Tutorial für Einsteiger',
			'release_date' => $oRelease,
			'asin'         => 'BHJUG238716'
		] );

		$oAuthor = Author::create( [
			'name'    => 'Stefan Riedel',
			'country' => 'Germany'
		] );

		$oBook->author()->associate( $oAuthor )->save();
		$this->assertEquals( 'Stefan Riedel', $oBook->author->name );
		$this->assertEquals( 'Germany', $oBook->author->country );
	}
}
