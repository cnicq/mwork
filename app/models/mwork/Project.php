<?php

use Illuminate\Support\Facades\URL;

class Project extends Eloquent {

	public function delete()
	{
		// Delete the comments
		$this->projects()->delete();

		return parent::delete();
	}


	/**
	 * Get the project owner.
	 *
	 * @return User
	 */
	public function owner()
	{
		return $this->belongsTo('User', 'userid');
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
