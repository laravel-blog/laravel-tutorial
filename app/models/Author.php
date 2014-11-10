<?php

/**
 * @created 07.11.14 - 14:48
 * @author stefanriedel
 */
class Author extends Eloquent {
	protected $fillable = array( 'name', 'country' );

	public function books() {
		return $this->hasMany( 'book' );
	}

}