<?php

class QuestionsController extends BaseController {

    /**
     * Show the root questions page at /questions
     *
     * @return View
     */
	public function index()
	{
		return View::make('questions.index');
	}

}
