<?php

use Illuminate\Support\Facades\URL;

class Candidate extends Eloquent {

	/**
	 * Deletes a candidate and all
	 * the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		return parent::delete();
	}

	public static function InProject($projId='', $caId='')
	{
		$r = Projectinfo::where('ca_id', '=', $caId)->where('proj_id', '=', $projId)->get();
		return count($r) > 0;
	}
	/**
	 * Returns a formatted candidate entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Get the candidate owner.
	 *
	 * @return User
	 */
	public function owner()
	{
		return $this->belongsTo('Candidate', 'userid');
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
