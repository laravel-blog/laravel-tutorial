<?php
/**
 * @created 26.11.14 - 14:26
 * @author stefanriedel
 */

use Models\Category;

class CategoryTest extends TestCase {

	public function testHasBooks() {
		$oRelease = new \Carbon\Carbon();
		$oRelease->setDate( 2014, 01, 01 );

		$oAuthor = \Models\Author::create( [
			'name'    => 'Stefan Riedel',
			'country' => 'Germany'
		] );

		$oBook1 = new \Models\Book ( [
			'name'         => 'Laravel Tutorial für Einsteiger',
			'release_date' => $oRelease,
			'asin'         => 'BHJUG238716',
			'iban'         => 'BHJUG2387161233423redaskjdh'
		] );

		$oBook1->author()->associate( $oAuthor )->save();

		$oBook2 = new \Models\Book ( [
			'name'         => 'Laravel Tutorial für Einsteiger',
			'release_date' => $oRelease,
			'asin'         => 'BHJUG238716',
			'iban'         => 'BHJUG2387161233423redaskjdh'
		] );

		$oBook2->author()->associate( $oAuthor )->save();

		$oCategory = $this->_getCategory();

		$oCategory->books()->sync([$oBook1->id, $oBook2->id]);



		$this->assertEquals(2, $oCategory->books()->count());



	}

	protected function _getCategory($sName = 'PHP', $blActive = true) {
		$oCategory = Category::create(['name' => $sName, 'active' => $blActive]);
		return $oCategory;
	}

}
