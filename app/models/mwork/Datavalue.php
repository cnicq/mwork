<?php

use Illuminate\Support\Facades\URL;

class Datavalue extends Eloquent {

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

	public static function getValues($type)
	{
		return Datavalue::where('type', '=', $type)->get();
	}

	public static function getValue($type, $name)
	{
		$row = Datavalue::where('type', '=', $type)->where('name', '=', $name)->first();
		if($row == null)
		{
			$row = new Datavalue();
		}

		return $row;
	}

	public static function getGenderText($gender)
	{
		if($gender == 'male')
		{
			return '男';
		}

		if($gender == 'female')
		{
			return '女';
		}

		return '';
	}

	public static function IsFinishStepName($stepName)
	{
		return (int)$stepName == 10 || (int)$stepName == 9;
	}

}
