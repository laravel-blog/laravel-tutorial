<?php
/**
 * @created 10.11.14 - 11:07
 * @author stefanriedel
 */

class AuthorTest extends TestCase {

public function testHasManyBooks() {
	$oRelease = new \Carbon\Carbon();
	$oRelease->setDate( 2014, 01, 01 );

	$oBook1 = new Book( [
		'name'         => 'Laravel Tutorial für Einsteiger',
		'release_date' => $oRelease,
		'asin'         => 'BHJUG238716'
	] );

	$oRelease->addMonths(6);

	$oBook2 = new Book( [
		'name'         => 'Laravel Tutorial für Forteschrittene',
		'release_date' => $oRelease,
		'asin'         => 'APOJUG238561'
	] );

	$oAuthor = Author::create( [
		'name'    => 'Stefan Riedel',
		'country' => 'Germany'
	] );

	$oAuthor->books()->save($oBook1);
	$oAuthor->books()->save($oBook2);
	$this->assertEquals(2, $oAuthor->books()->count());
}

}
