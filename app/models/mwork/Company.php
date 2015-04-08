<?php

class Company extends Eloquent {
    protected $table = 'companys';
	/**
	 * Get the Company author.
	 *
	 * @return Company
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
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
