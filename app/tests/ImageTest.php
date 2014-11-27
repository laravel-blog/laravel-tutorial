<?php
/**
 * @created 19.11.14 - 14:51
 * @author stefanriedel
 */

use Faker\Factory as Faker;

class ImageTest extends TestCase {

	public function testCreateAndDelete() {
		$oImage     = new \Models\Image();
		$sFakeImage = \Faker\Provider\Image::image( $dir = '/tmp', $width = 600, $height = 400 );
		$oImage->setOriginalImage( $sFakeImage );
		$oImage->save();

		$sBaseNameFakeImage = basename($sFakeImage);
		$sCheckPath = public_path('images/' . $sBaseNameFakeImage);
		$this->assertEquals($sCheckPath,  $oImage->getAbsolutePath());
		$oImage->delete();
		$this->assertFalse(File::exists($sCheckPath));
	}

	public function testUpdateAndDelete() {
		$oImage     = new \Models\Image();
		$sFakeImage = \Faker\Provider\Image::image( $dir = '/tmp', $width = 600, $height = 400 );
		$oImage->setOriginalImage( $sFakeImage );
		$oImage->save();

		/**
		 * after create
		 */
		$sBaseNameFakeImage = basename($sFakeImage);
		$sCheckPath = public_path('images/' . $sBaseNameFakeImage);
		$this->assertEquals($sCheckPath,  $oImage->getAbsolutePath());

		$sFakeImage2 = \Faker\Provider\Image::image( $dir = '/tmp', $width = 600, $height = 400 );
		$oImage->setOriginalImage($sFakeImage2);
		$oImage->save();

		/**
		 * after update
		 */
		$sBaseNameFakeImage = basename($sFakeImage2);
		$sCheckPath2 = public_path('images/' . $sBaseNameFakeImage);
		$this->assertEquals($sCheckPath2,  $oImage->getAbsolutePath());
		//created picture dont exists
		$this->assertFalse(File::exists($sCheckPath));
		$oImage->delete();
		$this->assertFalse(File::exists($sCheckPath2));
	}

	public function testGetImageUrl() {
		$oImage     = new \Models\Image();
		$sFakeImage = \Faker\Provider\Image::image( $dir = '/tmp', $width = 600, $height = 400 );
		$oImage->setOriginalImage( $sFakeImage );
		$oImage->save();
		$sBaseImageName = basename($sFakeImage);
		$this->assertEquals(Config::get('app.url') . '/images/' . $sBaseImageName, $oImage->getUrl());

	}

	public function setUp() {
		parent::setUp();
		$this->_resetEvents();
	}

	private function _resetEvents() {
		// Define the models that have event listeners.
		$aModels = array( 'Models\Image' );

		// Reset their event listeners.
		foreach ( $aModels as $sModel ) {

			// Flush any existing listeners.
			call_user_func( array( $sModel, 'flushEventListeners' ) );

			// Reregister them.
			call_user_func( array( $sModel, 'boot' ) );
		}
	}

}