<?php

class GeosantaraController extends BaseController{

	public function showGame()
	{
		$clues = Clue::all();
		$clue = "";
		if (count($clues) > 0)
		{
			$index = rand(0,count($clues) - 1);
			$clue = $clues[$index];
		}
		
		return View::make('index')
				->with('clue', $clue);
	}

	public function checkAnswer()
	{
		$clue = Clue::where('ClueID', '=', Input::get('dataSend'))->first();
		if (strpos( strtolower($clue->Answer), strtolower(Input::get('answerSend'))) !== false)
		{
			return "success";
		}
		else
		{
			return "failed";
		}
	}

	public function showAdminPanel()
	{
		$clues = Clue::all();
		return View::make('adminPanel')
			->with('clues',$clues);
	}

	public function showAddClue()
	{
		$clueID = Clue::generateID();
		return View::make('addClue')
			->with('clueID',$clueID);
	}

	public function addClue()
	{
		$validator = Validator::make(Input::all(), array(
			'clue' => 'required',
			'answer' => 'required'
		));

		if ($validator->fails())
		{
			return Redirect::route('addClue')
				->withErrors($validator)
				->withInput();
		}
		else
		{
			$clueID = Input::get('clueID');
			$clue = Input::get('clue');
			$answer = Input::get('answer');

			$create = Clue::create(array(
				'ClueID'	=> $clueID,
				'Clue'		=> $clue,
				'Answer' 	=> $answer
			));

			if ($create)
			{
				return Redirect::route('adminPanel');
			}
			else
			{
				return "Failed Add Clue";
			}
		}
	}

	public function showEditClue($clueID = null)
	{
		$clue = Clue::where('ClueID' , '=', $clueID)->first();
		return View::make('editClue')
			->with('clue', $clue);
	}

	public function editClue()
	{
		$validator = Validator::make(Input::all(), array(
			'clue' => 'required',
			'answer' => 'required'
		));

		if ($validator->fails())
		{
			return Redirect::to('admin/editClue/'.Input::get('clueID'))
				->withErrors($validator)
				->withInput();
		}
		else
		{
			$clueID = Input::get('clueID');
			$clue = Input::get('clue');
			$answer = Input::get('answer');


			$clueRes = Clue::where('ClueID', '=', $clueID)->first();
			$clueRes->Clue = $clue;
			$clueRes->Answer = $answer;
			$clueRes->save();

			return Redirect::route('adminPanel');
		}
	}

	public function deleteClue($clueID = null)
	{
		$clue = Clue::where('ClueID', '=', $clueID)->delete();
		return Redirect::route('adminPanel');
	}

	public function checkAnswerJS()
	{

	}

}