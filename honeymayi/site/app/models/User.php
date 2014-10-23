<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * Create the user a reset code that they can use to reset their password and save it
     *
     * @return integer The reset code
     */

    /**
     * Allows mass assignment for the model
     *
     * @var array
     */
    protected $fillable = ['username', 'firstname', 'surname', 'email', 'password'];

    /**
     * Create and return a password reset code for the user
     *
     * @return int
     */
    public function resetPassword()
    {
        // Create a reset code for the user to reset their password
        $this->resetcode = rand(1000, 9999);
        $this->save();
        return $this->resetcode;
    }

    /**
     * Hash the password upon assigning it to the model
     *
     * @param $pass The password
     */
    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
    }

    /**
     * The User can have many social Profiles
     *
     * @return mixed
     */
    public function profiles()
    {
        return $this->hasMany('Profile');
    }

    /**
     * Return the amount of requests which are pending for the user
     *
     * @return int
     */
    public function requestCount()
    {
        return DB::table('userlinkrequests')
            ->where('them', $this->id)
            ->count();
    }

    /**
     * Get the number of Honeys the user has
     *
     * @return int
     */
    public function honeyCount()
    {
        return DB::table('userlink')
            ->where('user1', $this->id)
            ->orwhere('user2', $this->id)
            ->count();
    }

    /**
     * Return the list of Honey that the user has
     *
     * @return array of honeys (User objects)
     */
    public function honeys()
    {
        $honeys = [];
        $userlinks = DB::table('userlink')
            ->where('user1', $this->id)
            ->orwhere('user2', $this->id)
            ->get();
        foreach ($userlinks as $link) {
            $honeyID = ($link->user1 == $this->id)
                ? $link->user2
                : $link->user1;
            $honeys[] = self::find($honeyID);
        }
        return $honeys;
    }

    public function honeysListForDropdown()
    {
        $honeys = [];
        $userlinks = DB::table('userlink')
            ->where('user1', $this->id)
            ->orwhere('user2', $this->id)
            ->get();
        foreach ($userlinks as $link) {
            $honeyID = ($link->user1 == $this->id)
                ? $link->user2
                : $link->user1;
            $username = self::where('id', $honeyID)->pluck('username');
            $honeys[$honeyID] = $username;
        }
        return $honeys;
    }

    /**
     * Determine if the current user is the Honey of another given user
     *
     * @param User $user
     *
     * @return bool
     */
    public function isHoneysWith(User $user)
    {
        return (DB::table('userlink')
                ->where(['user1' => $user->id, 'user2' => $this->id])
                ->orwhere(['user2' => $user->id, 'user1' => $this->id])
                ->count() !=0 );
    }

}
