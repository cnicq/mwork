<?php

use Illuminate\Support\Facades\URL;

class Cacomment extends Eloquent {

	public function delete()
	{
		// Delete the comments
		$this->cacomments()->delete();

		return parent::delete();
	}


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

	/**
	 * Returns the date of the blog post last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at);
	}

}
