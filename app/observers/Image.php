<?php
/**
 * @created 20.11.14 - 12:02
 * @author stefanriedel
 */

namespace Observer;

class Image {

	public function saving( \Models\Image $oModel ) {
		if($sOriginalImagePath = $oModel->getOriginalImage() AND \File::exists($sOriginalImagePath)) {

			if($oModel->exists()) {
				$this->_deleteImageFromStorage($oModel->getAbsolutePath());
			}

			//to copy image in exists path
			if(!\File::isDirectory(public_path('images'))) {
				\File::makeDirectory(public_path('images'), 777);
			}

			$sBaseName = basename($sOriginalImagePath);
			$sInPublicPath = 'images';
			$sImageDirPath = public_path($sInPublicPath);
			$sAbsolueImagePath = $sImageDirPath . '/' . $sBaseName;

			\File::copy($sOriginalImagePath, $sAbsolueImagePath);
			list($fWidth, $fHeight, $sType, $sAttr) = getimagesize($sAbsolueImagePath);
			$oModel->path = $sInPublicPath . '/' . $sBaseName;
			$oModel->width = $fWidth;
			$oModel->height = $fHeight;
			$oModel->ratio = ($fWidth/$fHeight);
			$oModel->size = filesize($sAbsolueImagePath);
			$oModel->mime = mime_content_type($sAbsolueImagePath);

		} elseif(!$oModel->exists() AND (!($sOriginalImagePath = $oModel->getOriginalImage()) OR !\File::exists($sOriginalImagePath))) {
			//das bild muss definitiv vorhanden sein
			return false;
		}

		if(!$oModel->imageable_id && !$oModel->imageable_type) {
			$oModel->imageable_id = 0;
			$oModel->imageable_type = '';
		}

	}

	public function deleted( \Models\Image $oModel) {
		//clean image physically from storage
		$sImagePath = $oModel->getAbsolutePath();
		$this->_deleteImageFromStorage($sImagePath);
	}

	protected function _deleteImageFromStorage($sImagePath) {
		if(\File::exists($sImagePath)) {
			\File::delete($sImagePath);
		}
	}

}