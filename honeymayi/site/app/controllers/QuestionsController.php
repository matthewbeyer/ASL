<?php

use Illuminate\Support\MessageBag;

class QuestionsController extends BaseController {

    /**
     * Show the root questions page at /questions
     */
	public function index()
	{
        // Fetching the user's questions
        $userQuestions = Question::where('user_id', Auth::user()->id)
            ->get();

        // Fetching default questions
        $defaultQuestions = Question::whereNull('user_id')
            ->get();

        // Fetching top 5 questions asked by user
        $top5Questions = Question::top5(Auth::user());
		return View::make('questions.index', [
                'userQuestions' => $userQuestions,
                'defaultQuestions' => $defaultQuestions,
                'top5Questions' => $top5Questions
            ]
        );
	}


    /**
     * Show the view for creating a new question
     */
    public function create()
    {
        return View::make('questions.create');
    }

    /**
     * Save the new Question in the database
     */
    public function store()
    {
        // Validate the input first
        $rules = array(
            'question' => 'required', // make sure the question is present
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            // Validation errors
            return Redirect::route('questions.create')
                ->withErrors($validator) // send back all errors to the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again.'
                ]);
        } else {
            // Check there is not already an identical question, either globally or locally
            $alreadyExists = (Question::where([
                'question' => Input::get('question'),
                'user_id'  => 0
            ])
            ->orWhere([
                    'question' => Input::get('questions'),
                    'user_id'  => Auth::user()->id
                ])
            ->count() != 0);
            if ($alreadyExists) {
                // Question already exists somewhere. Error.
                return Redirect::route('questions.create')
                    ->withInput(Input::all())
                    ->with([
                        'alert-type' => 'warning',
                        'alert-message' => 'That Question already exists.'
                    ]);
            }
            // Create the Question in the database
            $question = new Question([
                'question' => Input::get('question'),
                'user_id'  => Auth::user()->id
            ]);
            $question->save();
            // Redirect to the Question's stats page
            return Redirect::route('questions.show', ['question' => $question->id]);
        }
    }

    /**
     * Show the given Question's details page
     */
    public function show($questionID)
    {
        $question = Question::find($questionID);
        if (is_null($question)) {
            App::abort(404);
        } else {
            // Check that the user is allowed to view this question's detailed info
            if (!$question->canBeReadBy(Auth::user())) {
                // user not permitted to see this Question
                return Redirect::route('questions.index')
                    ->with([
                        'alert-type'    => 'warning',
                        'alert-message' => 'You do not have permission to view that Question.'
                    ]);
            }
            return View::make('questions.show', ['question' => $question]);
        }
    }

    /**
     * Delete a given question and all of its answers
     */
    public function destroy($questionID)
    {
        $question = Question::find($questionID);
        if (is_null($question)) {
            App::abort(404);
        } else {
            // Check that the user is allowed to destroy this question
            if (!$question->canBeDestroyedBy(Auth::user())) {
                // user not permitted to destroy this Question
                return Redirect::route('questions.show', ['question' => $question])
                    ->with([
                        'alert-type'    => 'warning',
                        'alert-message' => 'You do not have permission to delete that Question.'
                    ]);
            }
            $question->delete();
            return Redirect::route('questions.index')
                ->with([
                    'alert-type'    => 'success',
                    'alert-message' => 'Question successfully deleted.'
                ]);
        }
    }

    /**
     * Show the Ask page for the Question
     *
     * @param int $questionID The Question
     */
    public function showAsk($questionID)
    {
        $question = Question::find($questionID);
        if (is_null($question)) {
            App::abort(404);
        } else {
            // Check that the user is allowed to view this question's detailed info
            if (!$question->canBeReadBy(Auth::user())) {
                // user not permitted to destroy this Question
                return Redirect::route('questions.index')
                    ->with([
                        'alert-type'    => 'warning',
                        'alert-message' => 'You do not have permission to ask that Question.'
                    ]);
            }
            // Find a list of Honeys for the user
            $honeys = Auth::user()->honeysListForDropdown();
            // Show the ask view
            return View::make('questions.ask', ['question' => $question, 'honeyList' => $honeys]);
        }
    }

    /**
     * Ask the Question to the given User
     *
     * @param int $questionID The Question
     */
    public function doAsk($questionID)
    {
        // Validate the input first
        $rules = array(
            'honey'   => 'required',
            'message' => 'max:140'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('questions.ask', ['question' => $questionID])
                ->withErrors($validator)
                ->withInput(Input::all())
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again.'
                ]);
        } else {
            // Check the Honey ID is valid
            $honey = User::find(Input::get('honey'));
            if (is_null($honey)) {
                // le User no exist :(
                $messagebag = new MessageBag([
                    'honey' => 'That Honey does not exist.'
                ]);
                return Redirect::route('questions.ask', ['question' => $questionID])
                    ->withErrors($messagebag)
                    ->withInput(Input::all())
                    ->with([
                        'alert-type' => 'danger',
                        'alert-message' => 'Validation errors occurred. Please try again.'
                    ]);
            } else {
                // Check the Users are Honeys
                if (!Auth::user()->isHoneysWith($honey)) {
                    $messagebag = new MessageBag([
                        'honey' => 'You are not Honeys with that user'
                    ]);
                    return Redirect::route('questions.ask', ['question' => $questionID])
                        ->withErrors($messagebag)
                        ->withInput(Input::all())
                        ->with([
                            'alert-type' => 'danger',
                            'alert-message' => 'Validation errors occurred. Please try again.'
                        ]);
                }
            }
            // Check that the Question exists
            $question = Question::find($questionID);
            if (is_null($question)) {
                App::abort(404);
            }
            // Check that the user is allowed to view this question's detailed info
            if (!$question->canBeReadBy(Auth::user())) {
                // user not permitted to destroy this Question
                return Redirect::route('questions.index')
                    ->with([
                        'alert-type'    => 'warning',
                        'alert-message' => 'You do not have permission to ask that Question.'
                    ]);
            }
            // IF WE GET TO HERE THEN VALIDATION MUST HAVE BEEN SUCCESSFUL THIS FAR
            // So ask the question

            $questionAsked = QuestionAsked::create([
                'question_id' => $questionID,
                'asker_id'    => Auth::user()->id,
                'askee_id'    => Input::get('honey'),
                'message'     => Input::get('message')
            ]);
            // Send the askee an email notifying them that they have been asked a question
            Mail::send('emails.questions.received',
                ['questionAsked' => $questionAsked],
                function($message) use ($questionAsked) {
                $message->to($questionAsked->askee->email)->subject('Honey May I | Question Received');
            });
            return Redirect::route('questions.show', ['question' => $questionID])
                ->with([
                    'alert-type'    => 'success',
                    'alert-message' => 'Question asked!'
                ]);
        }
    }

    /**
     * Show the User's inbox
     */
    public function showInbox()
    {
        $pendingQuestions = QuestionAsked::pendingForUser(Auth::user());
        return View::make('questions.inbox', ['pendingQuestions' => $pendingQuestions]);
    }

    /**
     * Answer the given question with a yes or a no
     *
     * @param $questionAskedID int    The Question
     * @param $answer          string The Answer
     */
    public function answer($questionAskedID, $answer)
    {
        $answerAsBool = ($answer == "yes");
        $questionAsked = QuestionAsked::find($questionAskedID);
        if (is_null($questionAsked)) {
            return Redirect::route('questions.inbox')
                ->with([
                    'alert-type' => 'warning',
                    'alert-message' => 'No such question asked with ID: ' . $questionAskedID
                ]);
        }
        // Check if the current User is the askee
        if (Auth::user()->id != $questionAsked->askee_id) {
            // Not the askee!
            return Redirect::route('questions.inbox')
                ->with([
                    'alert-type' => 'warning',
                    'alert-message' => 'You cannot answer that question as it was not sent to you.'
                ]);
        } else {
            // User IS the askee, answer the question
            $questionAsked->answer = $answerAsBool;
            $questionAsked->save();
            // Send the asker an email notifying them that their question has been asked
            Mail::send('emails.questions.answered',
                ['questionAsked' => $questionAsked],
                function($message) use ($questionAsked) {
                    $message->to($questionAsked->asker->email)->subject('Honey May I | Question Answered');
                });
            return Redirect::route('questions.inbox')
                ->with([
                    'alert-type' => 'success',
                    'alert-message' => 'Question answered with a <b>' . $answer . '</b>!'
                ]);
        }
    }

    /************** QUESTIONS ANSWERED ******************/
    public function showAnswered()
    {
        $questionsAnswered = QuestionAsked::answeredByUser(Auth::user());
        return View::make('questions.answered', [
            'questionsAnswered' => $questionsAnswered
        ]);
    }

}
