<?php

use Illuminate\Support\MessageBag;

class UsersController extends BaseController {

    public function showLogin()
    {
        if (Auth::check()) {
            // user is already logged in, redirect to the dashboard
            return Redirect::route('dashboard');
        } else {
            // show the form
            return View::make('auth.login');
        }
    }
    public function doLogin()
    {
        // process the form
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')) // send back the input (not the password) so that we can repopulate the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occoured. Please try again'
                ]);
        } else {
            // create our user data for the authentication
            $userdata = array(
                'email' 	=> Input::get('email'),
                'password' 	=> Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                // validation successful!
                // redirect them to the page they initially tried to access or the dashboard
                return Redirect::intended('dashboard')
                    ->with([
                        'alert-type' => 'success',
                        'alert-message' => 'Login successful!'
                    ]);
            } else {
                // wrong password or username, send back to form

                return Redirect::to('login')
                    ->withInput(Input::except('password'))
                    ->with([
                        'alert-type' => 'danger',
                        'alert-message' => 'Incorrect username or password, please try again.'
                    ]);
            }
        }
    }

    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('')
            ->with([
                'alert-type' => 'success',
                'alert-message' => 'Logout successful!'
            ]);
    }


    public function showSignup()
    {
        if (Auth::check()) {
            // user is already logged in, redirect to the dashboard
            return Redirect::intened('dashboard');
        } else {
            if(Session::has('socialprofile')) {
                $socialprofile = Session::get('socialprofile');
                $profileID     = Session::get('profileID');

                Session::set('_old_input', [
                    'firstname' => $socialprofile->getFirstName(),
                    'surname'   => $socialprofile->getLastName(),
                    'email'     => $socialprofile->getEmail(),
                    'username'  => $socialprofile->getDisplayName(),
                    'profileID' => $profileID
                ]);
            }
            return View::make('auth.signup');
        }
    }
    public function doSignup()
    {
        $rules = array(
            'firstname'=> 'required',
            'surname'  => 'required',
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('signup')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password', 'password_confirmation')) // send back the input (not the password) so that we can repopulate the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occoured. Please try again',
                ]);
        } else {
            $data = Input::except('password_confirmation', 'terms');
            $user = DB::table('users')
                ->where('username', $data['username'])
                ->orwhere('email', $data['email'])
                ->first();
            if (!is_null($user)) {
                $messagebag = new MessageBag();
                if ($user->username == $data['username']) {
                    $messagebag->add('username', 'Username is already taken');
                }
                if ($user->email == $data['email']) {
                    $messagebag->add('email', 'Email address is already in use');
                }
                return Redirect::to('signup')
                    ->withErrors($messagebag)
                    ->withInput(Input::except('password', 'password_confirmation'))
                    ->with([
                        'alert-type' => 'danger',
                        'alert-message' => 'Username or email address already in use.'
                    ]);
            } else {
                $newUser = User::create($data);
                if ($newUser) {
                    if (Input::get('profileID') != "") {
                        $profileID = Input::get('profileID');
                        $profile = Profile::find($profileID);
                        if (is_null($profile)) {
                            return Redirect::to('signup')
                                ->withInput(Input::except('password', 'password_confirmation')) // send back the input (not the password) so that we can repopulate the form
                                ->with([
                                    'alert-type' => 'warning',
                                    'alert-message' => 'Profile with ID ' . $profileID . ' not found.',
                                ]);
                        }
                        $profile->user_id = $newUser->id;
                        $profile->save();
                    }
                    Auth::login($newUser);
                    return Redirect::intended('dashboard')
                        ->with([
                            'alert-type'    => 'success',
                            'alert-message' => 'Account created successfully!'
                        ]);
                } else {
                    return Redirect::to('signup')
                        ->with([
                       'alert-type' => 'danger',
                       'alert-message' => 'An error occurred while creating your account. Please try again later or contact support.'
                    ]);
                }
            }
        }
    }

    public function showForgot()
    {
        return View::make('auth.forgot');
    }
    public function doForgot()
    {
        // process the form
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // send back all errors to the password reset form
            return Redirect::to('forgot')
                ->withErrors($validator)
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again.'
                ]);
        } else {
            $email = Input::get('email');
            $user  = User::where('email', $email)->first();
            if(!is_null($user)) {
                // User exists. Set reset code and email them a link
                $resetcode = $user->resetPassword();
                // Mail the user
                Mail::send('emails.auth.passwordreset', ['code' => $resetcode], function($message) use ($user) {
                    $message->to($user->email)->subject('Honey May I | Password Reset');
                });

                return Redirect::to('');
            } else {
                $messagebag = new MessageBag([
                    'general' => 'Email address not found. Please check it and try again.'
                ]);
                return Redirect::to('forgot')->withErrors($messagebag);
            }
        }
    }

    public function showReset($code)
    {
        return View::make('auth.passwordreset', ['code' => $code]);
    }
    public function doReset($code)
    {
        // Reset the user's password
        // process the form
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email',          // make sure the email is an actual email
            'password' => 'required|min:6|confirmed' // Make sure passwords match and are valid
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            // send back all errors to the password reset form
            return Redirect::route('resetpassword', ['resetcode' => $code])
                ->withInput(Input::except(['password', 'password_confirmation']))
                ->withErrors($validator);
        } else {
            $email = Input::get('email');
            $user  = User::where('email', $email)->first();
            if(!is_null($user)) {
                // User exists. Check code
                if($user->resetcode == $code && $code != 0) {
                    // Code matches. Reset password
                    $password = Input::get('password');
                    $user->password = $password;
                    $user->resetcode = 0;
                    $user->save();
                    return Redirect::to('login')->with([
                        'alert-type' => "success",
                        'alert-message' => "Password successfully changed!"
                    ]);
                } else {
                    // Code does not match. Error.
                    $messagebag = new MessageBag([
                        'general' => 'Incorrect password reset code.'
                    ]);
                }
            } else {
                // No such user
                $messagebag = new MessageBag([
                    'general' => 'Email address not found. Please check it and try again.'
                ]);
            }
            return Redirect::route('resetpassword', ['code' => $code])
                ->withErrors($messagebag);
        }
    }

    /**
     * Show the 'My Account' page
     */
    public function showMyAccount()
    {
        $user = Auth::user();
        Session::set('_old_input', [
            'firstname' => $user->firstname,
            'surname'   => $user->surname,
            'email'     => $user->email,
            'username'  => $user->username
        ]);
        return View::make('auth.myaccount');
    }

    /**
     * Update the user's account info
     */
    public function doAccountUpdate()
    {
        $rules = array(
            'email'    => 'email',
            'password' => 'min:6|confirmed',
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('myaccount')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password', 'password_confirmation')) // send back the input (not the password) so that we can repopulate the form
                ->with([
                    'alert-type' => 'danger',
                    'alert-message' => 'Validation errors occurred. Please try again',
                ]);
        } else {
            $data = Input::except('password_confirmation', 'terms', 'username', '_token');
            $user = Auth::user();
            foreach ($data as $key => $value) {
                if (!empty($data[$key])) {
                    $user->$key = $value;
                }
            }
            $user->save();
            return Redirect::to('myaccount')
                ->with([
                    'alert-type' => 'success',
                    'alert-message' => 'Account information successfully updated!'
                ]);
        }
    }

    /**
     * Show the terms and conditions page
     */
    public function terms()
    {
        return View::make('auth.terms');
    }
}