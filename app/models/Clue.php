<?php

class Clue extends Eloquent {
	public $timestamps = false;
	protected $fillable = array('ClueID','Clue', 'Answer');
	protected $primaryKey = 'ClueID';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'msclue';

	protected function generateID()
	{
		$clue = DB::table('msclue')
						->select('ClueID')
						->distinct()
						->orderBy('ClueID','desc')
						->first();

		$newID = "CL000";
		if (count($clue) > 0)
		{
			$newLastID = substr($clue->ClueID, 2,3);
			$newLastID = ($newLastID+1);

			if ($newLastID<10)
			{
			    $newLastID = "00".$newLastID;
			}
			else if ($newLastID<100)
			{
			    $newLastID = "0".$newLastID;
			}
			$newID = "CL".$newLastID;
		}

		return $newID;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
