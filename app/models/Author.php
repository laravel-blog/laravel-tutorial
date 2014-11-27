<?php

/**
 * @created 07.11.14 - 14:48
 * @author stefanriedel
 */

namespace Models;

/**
 * Models\Author
 *
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Models\Book[] $books
 * @method static \Illuminate\Database\Query\Builder|\Models\Author whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Author whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Author whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Models\Author whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Models\Image[] $images
 */
class Author extends \Eloquent {

	/**
	 * @var array
	 */
	protected $fillable = array( 'name', 'country' );

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function books() {
		return $this->hasMany( 'Models\Book' );
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function images() {
		return $this->morphMany('Models\Image', 'imageable');
	}

}