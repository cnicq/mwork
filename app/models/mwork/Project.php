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

	public static function getLastStep($projId, $caId)
	{
		$info = Projectinfo::where('proj_id', '=', $projId)
		->where('ca_id', '=', $caId)->orderBy('updated_at', 'DESC')
		->first();
		if($info == null)
		{
			return '';
		}

		return $info->step;
	}

	public static function GetFinishHeadCount($projId)
	{
		$projectInfos = Projectinfo::select(DB::raw('ca_id, count(*) as cnt'))
		->where('proj_id', '=', $projId)
		->groupBy('ca_id')->get();

		$cnt = 0;
		foreach ($projectInfos as $value) {
			if(Datavalue::IsFinishStepName(Project::getLastStep($projId, $value->ca_id)))
			{
				$cnt++;
			}
		}
		return $cnt;
	}

}
