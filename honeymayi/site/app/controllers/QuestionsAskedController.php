<?php

/**
 * Class QuestionsAskedController
 *
 * Allows people (anyone for the sake of the class) to view the results of a single Question Asked (Q and A)
 * TODO:
 * This is to make social sharing easier for the time being but its use should be reviewed after class if this app is
 * to go into production
 */
class QuestionsAskedController extends BaseController {

    /**
     * Show a given Question Asked
     *
     * @param $questionAskedID int The Question Asked ID
     */
    public function show($questionAskedID)
    {
        // Show a given Question asked
        $questionAsked = QuestionAsked::find($questionAskedID);
        if (is_null($questionAsked)) {
            // Question asked does not exist
            App::abort(404);
        } else {
            return View::make('questions.asked.show', [
                'questionAsked' => $questionAsked
            ]);
        }
    }
} 