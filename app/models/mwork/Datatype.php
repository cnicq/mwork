<?php

use Illuminate\Support\Facades\URL;

class Datatype extends Eloquent {
	
	public $timestamps = false;
	/**
	 * Returns the date of the blog post creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

}
