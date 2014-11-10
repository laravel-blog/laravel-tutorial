<?php

/**
 * @created 07.11.14 - 14:34
 * @author stefanriedel
 */
class Book extends Eloquent {
	protected $fillable = array( 'name', 'release_date', 'asin' );

public function author() {
	return $this->belongsTo( 'author' );
}
}