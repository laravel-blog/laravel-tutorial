<?php

/**
 * @created 07.11.14 - 14:34
 * @author stefanriedel
 */


namespace Models;

/**
 * Models\Image
 *
 * @property integer $id
 * @property string $path
 * @property float $size
 * @property float $width
 * @property float $height
 * @property float $ratio
 * @property integer $imageable_id
 * @property string $imageable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereRatio($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereImageableId($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereImageableType($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Image whereUpdatedAt($value)
 */
class Image extends \Eloquent {


	/**
	 * @var array
	 */
	protected $fillable = array( 'path' );

	/**
	 * @var string
	 */
	protected $_sOriginalImage = '';

	/**
	 * @return string
	 */
	public function getOriginalImage() {
		return $this->_sOriginalImage;
	}

	/**
	 * @param string $sOriginalImage
	 */
	public function setOriginalImage( $sOriginalImage ) {
		$this->_sOriginalImage = $sOriginalImage;
		return $this;
	}

	public function getAbsolutePath() {
		return public_path($this->path);
	}

	public function getUrl() {
		return asset($this->path);
	}

	public static function boot() {
		parent::boot();
		static::observe(new \Observer\Image);
	}
}