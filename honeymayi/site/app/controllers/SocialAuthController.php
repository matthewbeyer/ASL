<?php

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
            return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
        }

        $facebook = new Facebook(Config::get('facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) {
            return Redirect::to('/')->with([
                'alert-type'    => 'danger',
                'alert-message' => 'There was an error'
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

        return Redirect::to('questions')->with([
            'alert-type'    => 'success',
            'alert-message' => 'Successfully logged in with Facebook!'
        ]);
    }
}