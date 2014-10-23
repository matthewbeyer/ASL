<?php

use Hybridauth\Hybridauth;

class SocialAuthController extends BaseController {

    /**
     * Login using Facebook
     */
    public function FBLogin()
    {
        // Login via FB
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('/login/fb/callback'),
            'scope' => 'email',
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    /**
     * Facebook login callback
     */
    public function FBLoginCallback()
    {
        // FB Login calback
        $code = Input::get('code');
        if (strlen($code) == 0) {
            return Redirect::to('/')->with([
                'alert-type'    => 'danger',
                'alert-message' => 'There was an error communicating with Facebook. Please try again.'
            ]);
        }

        $facebook = new Facebook(Config::get('facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) {
            return Redirect::to('/')->with([
                'alert-type'    => 'danger',
                'alert-message' => 'There was an error communicating with Facebook. Please try again.'
            ]);
        }

        $me = $facebook->api('/me');

        $profile = Profile::whereUid($uid)->first();
        if (empty($profile)) {
            $user = User::whereEmail($me['email'])->first();
            if (empty($user)) {
                // User does not already have an account. Register them.
                $user = new User;
                $user->firstname = $me['first_name'];
                $user->surname   = $me['last_name'];
                $user->username  = "FB" . $me['id'];
                $user->email     = $me['email'];
                // $user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';

                $user->save();
            }

            $profile = new Profile();
            $profile->uid = $uid;
            $profile->username = "FB" . $me['id'];
            $profile = $user->profiles()->save($profile);
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        $user = $profile->user;

        Auth::login($user);

        return Redirect::intended('dashboard')->with([
            'alert-type'    => 'success',
            'alert-message' => 'Successfully logged in with Facebook!'
        ]);
    }

    /**
     * Log the user in using a social network
     *
     * @param $network string The social network we ae using
     * @return mixed
     */
    public function SocialLogin($network)
    {
        $network = ucfirst($network);

        $hybridAuth = new Hybridauth(Config::get('hybridauth'));
        $adapter = $hybridAuth->authenticate($network);
        $userProfile = $adapter->getUserProfile();

        // Network specific stuff. Some give us emails/usernames, some don't
        if($network == "Google" || $network == "Facebook") {
            $userProfile->setDisplayName(str_replace(
                " ",
                "",
                $userProfile->getDisplayName()
            ));
        } elseif($network == "Twitter") {
            $fullname = explode(" ", $userProfile->getFirstName());
            $userProfile->setFirstName($fullname[0]);
            $userProfile->setLastName($fullname[1]);
        }

        // Try and get the user's profile if they have already signed in socially with this network before
        $profile = Profile::whereUid($userProfile->getIdentifier())->first();

        if (empty($profile)) {
            // User's first time using this network to sign in, create profile
            $profile                = new Profile;
            $profile->uid           = $userProfile->getIdentifier();
            $profile->access_token  = $userProfile->getAdapter()->getTokens()->accessToken;
            if(!empty($userProfile->getAdapter()->getTokens()->accessSecretToken)) {
                $profile->access_token_secret = $userProfile->getAdapter()->getTokens()->accessSecretToken;
            }
            $profile->save();
        }

        // Find user with the same email to see if they already have an account, maybe from a manual signup or another social network
        $user = User::where('email', $userProfile->getEmail())->first();
        if(!is_null($user)) {
            // User has an account, set the profile's user_id to the user's id
            $profile->user_id = $user->id;
            $profile->save();
        }
        $user = $profile->user;
        if (is_null($user)) {

            // This is the user's first time. Redirect them to the sign up page to complete registration
            return Redirect::route('signup')->with([
                'socialprofile' => $userProfile,
                'profileID'     => $profile->id,
                'alert-type'    => 'info',
                'alert-message' => 'Please fill in the rest of the sign up form to complete your account setup.'
            ]);
        } else {
            // User already has an account. Log them in and send them to their dashboard
            Auth::login($user);
            return Redirect::intended('dashboard')->with([
                'alert-type'    => 'success',
                'alert-message' => 'Successfully logged in with ' . $network . '!'
            ]);
        }
    }

    /**
     * Social login callback
     */
    public function SocialLoginCallback()
    {
        $endPoint = new \Hybridauth\Endpoint();
        $endPoint->process();
    }
}