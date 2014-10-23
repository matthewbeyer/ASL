<?php

use Illuminate\Support\MessageBag;

/**
 * Class QuestionsUsersController
 *
 * Contains methods for displaying information to an asker of a Question on users which answered a given question
 */
class QuestionsUsersController extends BaseController {

    /**
     * Show statistics for the given user and question
     *
     * GET /questions/{question}/users/{user}
     *
     * @param $questionID int The Question ID
     * @param $userID     int The User ID
     *
     * @return mixed
     */
    public function show($questionID, $userID)
    {
        // First find the question
        $question = Question::find($questionID);
        if (is_null($question)) {
            // Question does not exist. Error out
            App::abort(404);
        }

        // Question exists. Check the user can access it.
        if (!$question->canBeReadBy(Auth::user())) {
            // user not permitted to see this Question
            return Redirect::route('questions.index')
                ->with([
                    'alert-type'    => 'warning',
                    'alert-message' => 'You do not have permission to view that Question.'
                ]);
        }

        // Question exists and use can access it. Check the user does and check that the two are Honeys
        $user = User::find($userID);
        if (is_null($user)) {
            // User does not exist. Error out
            App::abort(404);
        }
        if (!Auth::user()->isHoneysWith($user)) {
            // They are not Honeys
            return Redirect::route('questions.show', ['question' => $questionID])
                ->with([
                    'alert-type' => 'warning',
                    'alert-message' => 'This person is not one of your Honeys!'
                ]);
        }

        // All good. Render the view
        return View::make('questions.users/show', [
            'question' => $question,
            'user' => $user
        ]);
    }
}
