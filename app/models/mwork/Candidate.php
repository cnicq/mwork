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

 	public static function dealWithData(&$candidate)
    {
        $company = DB::table('companys')->where('id','=',$candidate['company'])->first();
        if($company == null)
        {	
            $candidate['company'] = '/';
        }
        else 
        {
            $candidate['company'] = $company->chinesename;
        }
        $candidate['position'] = Datavalue::getvalue('position', $candidate['position'])->text;
        $candidate['gender'] = Datavalue::getGenderText($candidate['gender']);
    }

    public static function dealWithDatas(&$candidates)
    {
        foreach ($candidates as $key1 => $value1) 
        {
            Candidate::dealWithData($value1);
        }
    }

	public static function InProject($projId='', $caId='')
	{
		$r = Projectinfo::where('ca_id', '=', $caId)->where('proj_id', '=', $projId)->get();
		return count($r) > 0;
	}

	public static function IsOwn($caId, $userId)
	{
		$r = Candidateown::where('ca_id', '=', $caId)->where('owner_id', '=', $userId)->get();
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
