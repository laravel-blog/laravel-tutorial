<?php
/**
 * @created 26.11.14 - 13:58
 * @author stefanriedel
 */

namespace Models;


/**
 * Models\Category
 *
 * @property integer $id
 * @property string $name
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Models\Book[] $books
 * @method static \Illuminate\Database\Query\Builder|\Models\Category whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Models\Category whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Models\Category whereActive($value) 
 * @method static \Illuminate\Database\Query\Builder|\Models\Category whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Models\Category whereUpdatedAt($value) 
 */
class Category extends \Eloquent {

	protected $fillable = ['name', 'active'];

	public function books() {
		return $this->belongsToMany('Models\Book');
	}

}