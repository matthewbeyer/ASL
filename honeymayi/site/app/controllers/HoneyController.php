<?php

class HoneyController extends BaseController {

    /**
     * Displays the list of the user's Honeys
     */
    public function index()
    {
        $user = Auth::user();
        $honeys = [];
        $userlinks = DB::table('userlink')
            ->where('user1', $user->id)
            ->orwhere('user2', $user->id)
            ->get();
        foreach ($userlinks as $link) {
            $honeyID = ($link->user1 == $user->id)
                ? $link->user2
                : $link->user1;
            $honeys[] = User::find($honeyID);
        }

        return View::make('honeys.index', ['honeys' => $honeys]);
    }

    /**
     * Show the add a new Honey (create a userlink) page
     */
    public function showAdd()
    {
        return View::make('honeys.add');
    }

    /**
     * Actually add the Honey
     */
    public function doAdd()
    {
        // Validate the input first
        $rules = array(
            'username' => 'required', // make sure the username is present
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('honeyAdd')
                ->withErrors($validator) // send back all errors to the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again'
                ]);
        } else {
            // Find the user they are trying to add
            $user = User::where('username', Input::get('username'))->first();
            if (is_null($user)) {
                // Invalid username
                return Redirect::route('honeyAdd')
                    ->with([
                        'alert-type' => 'danger',
                        'alert-message' => 'Unknown user. Please check the username and try again.'
                    ]);
            } else {
                // Correct username

                // First check that the person is not already a Honey
                $alreadyfriends = (DB::table('userlink')
                    ->where(['user1' => Auth::user()->id, 'user2' => $user->id])
                    ->orwhere(['user2' => Auth::user()->id, 'user1' => $user->id])
                    ->count() !=0 );
                if ($alreadyfriends) {
                    // They are already friends
                    return Redirect::route('honeyAdd')
                        ->with([
                            'alert-type' => 'warning',
                            'alert-message' => 'This person is already one of your Honeys!'
                        ]);
                }

                // Check that a request has not already been sent
                $alreadysent = (DB::table('userlinkrequests')
                    ->where(['you' => Auth::user()->id, 'them' => $user->id])
                    ->count() != 0);
                if ($alreadysent) {
                    // A friend request is already pending
                    return Redirect::route('honeyAdd')
                        ->with([
                            'alert-type' => 'warning',
                            'alert-message' => 'You have already sent this person a Honey request, and it is pending.'
                        ]);
                }

                // Valid request, add them
                DB::table('userlinkrequests')->insert(
                    array('you' => Auth::user()->id, 'them' => $user->id)
                );
                // TODO: send the request email here.
                return Redirect::route('honeys')
                    ->with([
                        'alert-type' => 'info',
                        'alert-message' => 'Honey requested.'
                    ]);
            }
        }
    }

    /**
     * Show the user's Honey requests
     */
    public function showRequests()
    {

    }

    /**
     * Delete the current Honey link
     */
    public function delete($userID)
    {
        $userlink = DB::table('userlink')
            ->where('user1', $userID)
            ->orwhere('user2', $userID)
            ->delete();
        return Redirect::route('honeys')
            ->with([
                'alert-type'    => 'success',
                'alert-message' => 'The Honey has been removed.'
            ]);
    }

}