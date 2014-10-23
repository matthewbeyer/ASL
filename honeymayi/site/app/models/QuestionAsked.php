<?php

class QuestionAsked extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'questions_asked';

    /**
     * Allows mass assignment for the model
     *
     * @var array
     */
    protected $fillable = ['question_id', 'asker_id', 'askee_id', 'message', 'answer'];

    /**
     * Define the relation between this and a Question
     *
     * @return Question
     */
    public function question()
    {
        return $this->belongsTo('Question');
    }

    /**
     * Return the User who asked the question
     *
     * @return User
     */
    public function asker()
    {
        return $this->belongsTo('User', 'asker_id');
    }

    /**
     * Return the User who the question was asked to
     *
     * @return User
     */
    public function askee()
    {
        return $this->belongsTo('User', 'askee_id');
    }

    /**
     * Returns the pending Question count for the given User
     *
     * @return int
     *
     * @param $user user The User in question
     */
    public static function pendingForUserCount(User $user)
    {
        return self::where([
            'askee_id' => $user->id,
        ])
            ->whereNull('answer')
            ->count();
    }

    /**
     * Returns the pending Questions for the given User
     *
     * @return int
     *
     * @param $user user The User in question
     */
    public static function pendingForUser(User $user)
    {
        return self::where([
            'askee_id' => $user->id,
        ])
            ->whereNull('answer')
            ->get();
    }

    /**
     * Return a DB query to get all the questions answered by a given user
     * ordered from newest to oldest
     *
     * @param User $user The User who answered the questions
     */
    public static function answeredByUser(User $user)
    {
        return self::where([
            'askee_id' => $user->id,
        ])
            ->whereNotNull('answer')
            ->orderBy('updated_at', 'DESC');
    }

    /**
     * Return a DB query to get all the questions asked by a given user
     * ordered from newest to oldest
     *
     * @return Relation
     *
     * @param User $user The User who asked the questions
     */
    public static function askedByUser(User $user)
    {
        return self::where([
            'asker_id' => $user->id,
        ])
            ->whereNotNull('answer')
            ->orderBy('created_at', 'DESC');
    }

    /**
     * Return the total number of questions asked that were answered with a yes
     * either globally or for a given user
     *
     * @return int
     *
     * @param User $asker The user who asked the questions
     * @param User $askee (optional) The user to have answered the questions
     */
    public static function personalTotalYesAskedCount(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => true
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'answer' => true
                ])
                ->count();
        }
    }

    /**
     * Return the total number of questions asked that were answered with a no
     * either globally or for a given user
     *
     * @return int
     *
     * @param User $asker The user who asked the questions
     * @param User $askee (optional) The user to have answered the questions
     */
    public static function personalTotalNoAskedCount(User $asker, User $askee = null)
    {
        if (!is_null($askee)) {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => false
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'answer' => false
                ])
                ->count();
        }
    }

    /**
     * Return the amount of times all questions asked by a given user has been answered with a 'YES' by a
     * given Honey, or overall AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $asker User The user who asked the questions
     * @param $askee User (optional) The user who answered the questions, or null for an overall count
     */
    public static function personalTotalYesAskedCountAsDecimal(User $asker, User $askee = null)
    {
        $totalAsked = QuestionAsked::askedByUser($asker)->count();
        $totalYes   = self::personalTotalYesAskedCount($asker, $askee);
        return ($totalAsked != 0)
            ? round(($totalYes / $totalAsked), 2)
            : 0;
    }

    /**
     * Return the amount of times all questions asked by a given user has been answered with a 'NO' by a
     * given Honey, or overall AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $asker User The user who asked the questions
     * @param $askee User (optional) The user who answered the questions, or null for an overall count
     */
    public static function personalTotalNoAskedCountAsDecimal(User $asker, User $askee = null)
    {
        $totalAsked = QuestionAsked::askedByUser($asker)->count();
        $totalNo    = self::personalTotalNoAskedCount($asker, $askee);
        return ($totalAsked != 0)
            ? round(($totalNo / $totalAsked), 2)
            : 0;
    }

    /**
     * Return the total number of questions answered by a user with a yes
     * either globally or ones asked by a given user
     *
     * @return int
     *
     * @param User $askee The user who answerd the questions
     * @param User $asker (optional) The user to have asked the questions
     */
    public static function personalTotalYesAnsweredCount(User $askee, $asker = null)
    {
        if (!is_null($asker)) {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => true
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'askee_id' => $askee->id,
                    'answer' => true
                ])
                ->count();
        }
    }

    /**
     * Return the total number of questions answered by a user with a no
     * either globally or ones asked by a given user
     *
     * @return int
     *
     * @param User $askee The user who answered the questions
     * @param User $asker (optional) The user to have asked the questions
     */
    public static function personalTotalNoAnsweredCount(User $askee, $asker = null)
    {
        if (!is_null($asker)) {
            return DB::table('questions_asked')
                ->where([
                    'asker_id' => $asker->id,
                    'askee_id' => $askee->id,
                    'answer' => false
                ])
                ->count();
        } else {
            return DB::table('questions_asked')
                ->where([
                    'askee_id' => $askee->id,
                    'answer' => false
                ])
                ->count();
        }
    }

    /**
     * Return the amount of times all questions has been answered with a 'YES' by a given Honey, or overall
     * AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $askee User The user who answered the questions
     * @param $asker User (optional) The user who asked the questions, or null for an overall count
     */
    public static function personalTotalYesAnsweredCountAsDecimal(User $askee, User $asker = null)
    {
        $totalAnswered = QuestionAsked::answeredByUser($askee)->count();
        $totalYes      = self::personalTotalYesAnsweredCount($askee, $asker);
        return ($totalAnswered != 0)
            ? round(($totalYes / $totalAnswered), 2)
            : 0;
    }

    /**
     * Return the amount of times all questions has been answered with a 'NO' by a given Honey, or overall
     * AS A DECIMAL or ZERO if the question has never been answered.
     *
     * @return float
     *
     * @param $askee User The user who answered the questions
     * @param $asker User (optional) The user who asked the questions, or null for an overall count
     */
    public static function personalTotalNoAnsweredCountAsDecimal(User $askee, User $asker = null)
    {
        $totalAnswered = QuestionAsked::answeredByUser($askee)->count();
        $totalNo      = self::personalTotalNoAnsweredCount($askee, $asker);
        return ($totalAnswered != 0)
            ? round(($totalNo / $totalAnswered), 2)
            : 0;
    }

}
