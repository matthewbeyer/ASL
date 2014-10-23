<?php

class Question extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'questions';

    /**
     * Allows mass assignment for the model
     *
     * @var array
     */
    protected $fillable = ['question', 'user_id'];

    /**
     * Return the amount of times this question has been answered by a given Honey, or overall
     *
     * @return int
     *
     * @param $asker User The user who asked the question
     * @param $askee User (optional) The user who answered the question, or null for an overall count
     */
    public function personalAnswerCount(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            return DB::table('questions_asked')
                ->where([
                        'question_id' => $this->id,
                        'asker_id' => $asker->id,
                        'askee_id' => $askee->id
                    ])
                ->whereNotNull('answer')
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'question_id' => $this->id,
                    'asker_id' => $asker->id
                ])
                ->whereNotNull('answer')
                ->count();
        }
    }

    /**
     * Return the amount of different Honeys who answered this Question for a given User
     *
     * @return int
     *
     * @param User $asker The User asking the question
     */
    public function personalHoneysAnsweredCount(User $asker)
    {
        return DB::table('questions_asked')
            ->where([
                'question_id' => $this->id,
                'asker_id'    => $asker->id
            ])
            ->whereNotNull('answer')
            ->count(DB::raw('DISTINCT askee_id'));
    }

    /**
     * Return the amount of times this question has been answered with a 'YES' by a given Honey, or overall
     *
     * @return int
     *
     * @param $asker User The user who asked the question
     * @param $askee User (optional) The user who answered the question, or null for an overall count
     */
    public function personalYesAnswerCount(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            return DB::table('questions_asked')
                ->where([
                    'question_id' => $this->id,
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => true
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'question_id' => $this->id,
                    'asker_id' => $asker->id,
                    'answer' => true
                ])
                ->count();
        }
    }

    /**
     * Return the amount of times this question has been answered with a 'NO' by a given Honey, or overall
     *
     * @return int
     *
     * @param $asker User The user who asked the question
     * @param $askee User (optional) The user who answered the question, or null for an overall count
     */
    public function personalNoAnswerCount(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            return DB::table('questions_asked')
                ->where([
                    'question_id' => $this->id,
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => false
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'question_id' => $this->id,
                    'asker_id' => $asker->id,
                    'answer' => false
                ])
                ->count();
        }
    }

    /**
     * Return the amount of times this question has been answered with a 'YES' by a given Honey, or overall
     * AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $asker User The user who asked the question
     * @param $askee User (optional) The user who answered the question, or null for an overall count
     */
    public function personalYesAnswerCountAsDecimal(User $asker, User $askee = null)
    {
        $total = $this->personalAnswerCount($asker, $askee);
        return ($total != 0)
               ? round(($this->personalYesAnswerCount($asker, $askee) / $total), 2)
               : 0;
    }

    /**
     * Return the amount of times this question has been answered with a 'NO' by a given Honey, or overall
     * AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $asker User The user who asked the question
     * @param $askee User (optional) The user who answered the question, or null for an overall count
     */
    public function personalNoAnswerCountAsDecimal(User $asker, User $askee = null)
    {
        $total = $this->personalAnswerCount($asker, $askee);
        return ($total != 0)
               ? round(($this->personalNoAnswerCount($asker, $askee) / $total), 2)
               : 0;
    }

    /**
     * Return the top 5 questions that a given User asks either on the whole or to a given Honey
     *
     * @param User $asker The User asking the question
     * @param User $askee (optional) The User the question was asked to
     *
     * @return array of Users
     */
    public static function top5(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            $questionIDs = DB::table('questions_asked')
                ->select("*", DB::raw("COUNT('question_id') AS times_asked"))
                ->where([
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                ])
                ->groupBy('asker_id')
                ->orderBy(DB::raw('times_asked'), 'DESC')
                ->take(5)
                ->get();
        } else {
            $questionIDs = DB::table('questions_asked')
                ->select("*", DB::raw("COUNT('question_id') AS times_asked"))
                ->where([
                    'asker_id' => $asker->id,
                ])
                ->groupBy('asker_id')
                ->orderBy(DB::raw('times_asked'), 'DESC')
                ->take(5)
                ->get();
        }
        $questions = [];
        foreach ($questionIDs as $questionAsked) {
            $question = self::find($questionAsked->question_id);
            $question->times_asked = $questionAsked->times_asked;
            $questions[] = $question;
        }
        return $questions;

    }

    /**
     * Return whether the given User is permitted to view detailed information about this Question
     *
     * @return bool
     *
     * @param User $user The User in question
     */
    public function canBeReadBy(User $user)
    {
        if (empty($this->user_id)) {
            return true;
        } else {
            return ($this->user_id == $user->id);
        }
    }

    /**
     * Return whether the given User is permitted to destroy this Question and all of its associated
     * statistics and answers
     *
     * @return bool
     *
     * @param User $user The User in question
     */
    public function canBeDestroyedBy(User $user)
    {
        if (empty($this->user_id)) {
            return false;
        } else {
            return ($this->user_id == $user->id);
        }
    }

    /**
     * Describes the one-to-many relationship between a Question and the relevant Questions Asked for it.
     *
     * @param $askee User (optional) The User to have answered the Question
     *
     * @return mixed
     */
    public function questionsAsked(User $askee = null)
    {
        if (is_null($askee)) {
            return $this->hasMany('QuestionAsked');
        } else {
            return $this->hasMany('QuestionAsked')->where([
                'askee_id' => $askee->id,
            ]);
        }
    }

    /**
     * Get the list of questions asked but only the ones that have been answered
     *
     * @param $askee User (optional) The Honey that the question was asked to
     *
     * @return array
     */
    public function questionsAskedAnswered(User $askee = null)
    {
        return $this->questionsAsked($askee)
            ->whereNotNull('answer')
            ->orderBy('updated_at', 'DESC');
    }

    /**
     * Get the list of questions asked but only the ones that have NOT been answered
     *
     * @param $askee user (optional) The Honey that the question was asked to
     *
     * @return array
     */
    public function questionsAskedNotAnswered(User $askee = null)
    {
        return $this->questionsAsked($askee)
            ->whereNull('answer')
            ->orderBy('updated_at', 'DESC');
    }

}