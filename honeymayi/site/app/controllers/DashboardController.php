<?php

class DashboardController extends BaseController {

    /**
     * Show the dashboard page at /
     *
     * @return View
     */
	public function index()
	{
        $totalQuestionsAsked    = QuestionAsked::askedByUser(Auth::user())->count();
        $totalQuestionsAnswered = QuestionAsked::answeredByUser(Auth::user())->count();

        $overallAskedYes = QuestionAsked::personalTotalYesAskedCount(Auth::user());
        $overallAskedNo  = QuestionAsked::personalTotalNoAskedCount(Auth::user());
        $overallAskedYesPercentage  = QuestionAsked::personalTotalYesAskedCountAsDecimal(Auth::user()) * 100;
        $overallAskedNoPercentage   = QuestionAsked::personalTotalNoAskedCountAsDecimal(Auth::user()) * 100;

        $overallAnsweredYes = QuestionAsked::personalTotalYesAnsweredCount(Auth::user());
        $overallAnsweredNo  = QuestionAsked::personalTotalNoAnsweredCount(Auth::user());
        $overallAnsweredYesPercentage  = QuestionAsked::personalTotalYesAnsweredCountAsDecimal(Auth::user()) * 100;
        $overallAnsweredNoPercentage   = QuestionAsked::personalTotalNoAnsweredCountAsDecimal(Auth::user()) * 100;

		return View::make('dashboard.index', [
            'totalQuestionsAnswered' => $totalQuestionsAnswered,
            'totalQuestionsAsked' => $totalQuestionsAsked,

            'overallAskedYes' => $overallAskedYes,
            'overallAskedNo'  => $overallAskedNo,
            'overallAskedYesPercentage'  => $overallAskedYesPercentage,
            'overallAskedNoPercentage'   => $overallAskedNoPercentage,

            'overallAnsweredYes' => $overallAnsweredYes,
            'overallAnsweredNo'  => $overallAnsweredNo,
            'overallAnsweredYesPercentage'  => $overallAnsweredYesPercentage,
            'overallAnsweredNoPercentage'   => $overallAnsweredNoPercentage
        ]);
	}

}
