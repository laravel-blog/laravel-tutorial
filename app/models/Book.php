<?php

/**
 * @created 07.11.14 - 14:34
 * @author stefanriedel
 */

namespace Models;

/**
 * Models\Book
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $release_date
 * @property string $asin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $iban
 * @property-read \Models\Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Models\Image[] $images
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereReleaseDate($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereAsin($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Book whereIban($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Models\Category[] $categories
 * @method static \Models\Book asin($sAsin) 
 * @method static \Models\Book authorName($sAuthorName) 
 */
class Book extends \Eloquent {

	/**
	 * @var array
	 */
	protected $fillable = array( 'name', 'release_date', 'asin' );

	protected $dates = ['created_at', 'updated_at', 'release_date'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author() {
		return $this->belongsTo( 'Models\Author' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function images() {
		return $this->morphMany('Models\Image', 'imageable');
	}

	public function scopeAsin($oQuery, $sAsin) {
		return $oQuery->whereAsin($sAsin);
	}

	public function scopeAuthorName($oQuery, $sAuthorName) {
		return $oQuery->with(['author' => function($oQuery) use($sAuthorName){
			$oQuery->whereName($sAuthorName);
		}]);
	}

	public function categories() {
		return $this->belongsToMany('Models\Category');
	}


}