<?php

class Profile extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

    /**
     * Profile belongs to a single User
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}
