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
}
