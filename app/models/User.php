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
	protected $fillable = array('email','permissions','activated','activated_at','last_login','first_name','last_name','user_id','user_type','is_agent');

    /**
     * hidden columns
     */
    protected $hidden = array('password','persist_code','reset_password_code','activation_code');

    public static function UsersList($orderBy='first_name', $sortBy='asc', $toArray=false) {
        $out = Sentry::getUserProvider()->createModel()
            ->join('throttle', 'throttle.user_id', '=', 'users.id', 'left')
            ->groupBy('users.id')
            ->orderBy('users.'.$orderBy, $sortBy)
            ->select('throttle.*','users.*')
            ->get();

        if($toArray) {
            $out = $out->toArray();
        }

        return $out;
    }

    public static function FindUserByEmail($email)
    {
      return  User::where('email','like',"%".$email."%")->get();
    }
}
