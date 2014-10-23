<?php

class HoneyController extends BaseController {

    /**
     * Displays the list of the user's Honeys
     */
    public function index()
    {
        $user = Auth::user();
        $honeys = $user->honeys();

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
            // Validation errors
            return Redirect::route('honeyAdd')
                ->withErrors($validator) // send back all errors to the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again'
                ]);
        } else {
            // make sure the user is not trying to add themselves
            if (Input::get('username') == Auth::user()->username) {
                return Redirect::route('honeyAdd')
                    ->with([
                        'alert-type' => 'warning',
                        'alert-message' => 'You can\'t add yourself!'
                    ]);
            }
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
                if (Auth::user()->isHoneysWith($user)) {
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

                // Mail the user, letting them know of their latest request
                Mail::send('emails.honeys.request', ['user' => Auth::user()], function($message) use ($user) {
                    $message->to($user->email)->subject('Honey May I | New Honey Request');
                });

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
        $honeys = [];
        $requests = DB::table('userlinkrequests')
            ->where('them', Auth::user()->id)
            ->get();
        foreach ($requests as $link) {
            $honeys[] = User::find($link->you);
        }
        return View::make('honeys.requests', ['requests' => $honeys]);
    }

    /**
     * Accept or decline a honey request
     *
     * @param $userID   int    The Honey ID who sent the request
     * @param $response string Either 'accept' or 'decline'
     */
    public function answerRequest($userID, $response)
    {
        $pastTense = ($response == "accept") ? 'accepted' : 'declined';
        // Check if such a request exists
        $request = DB::table('userlinkrequests')
            ->where([
                'them' => Auth::user()->id,
                'you' => $userID
            ])
            ->first();
        if (is_null($request)) {
            // No such request
            return Redirect::route('honeyRequests')
                ->with([
                    'alert-type'    => 'danger',
                    'alert-message' => "The Honey request could not be $pastTense as it doesn't exist (maybe it was already accepted or declined?)"
                ]);
        } else {
            if ($response = 'accept') {
                // Create a new userlink
                DB::table('userlink')->insert(
                    array('user1' => Auth::user()->id, 'user2' => $userID)
                );
            }
            // Delete the Honey request
            DB::table('userlinkrequests')
                ->where([
                    'them' => Auth::user()->id,
                    'you' => $userID
                ])
                ->delete();
            return Redirect::route('honeyRequests')
                ->with([
                    'alert-type'    => 'success',
                    'alert-message' => "Honey request $pastTense"
                ]);
        }
    }

    /**
     * Delete the current Honey link
     */
    public function delete($userID)
    {
        $success = DB::table('userlink')
            ->where('user1', $userID)
            ->orwhere('user2', $userID)
            ->delete();
        if ($success) {
            return Redirect::route('honeys')
                ->with([
                    'alert-type'    => 'success',
                    'alert-message' => 'The Honey has been removed.'
                ]);
        } else {
            return Redirect::route('honeys')
                ->with([
                    'alert-type'    => 'danger',
                    'alert-message' => 'There was an error while trying to remove that Honey.'
                ]);
        }
    }

}