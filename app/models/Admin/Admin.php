<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:48 PM
 */

class Admin extends Eloquent{

    /**
     * Table Name
     * @var STRING
     */
    protected $table="admins";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('first_name','last_name', 'email','photos','contact_number');

    /**
     * polymorphic relation it will fetch all notification for admin only
     * @return mixed
     */

    public function UnreadNotifications()
    {
        return $this->morphMany('Notification','receiver')->where('read_status',0)->orderBy('id','DESC');
    }

    public function Comments()
    {
        return $this->morphMany('Comment','honour')->where('honour_type','Admin');
    }

    public function Notifications()
    {
        return $this->morphMany('Notification','receiver')->orderBy('id','desc');
    }

    public function User()
    {
        return $this->morphMany('Cartalyst\Sentry\Users\Eloquent\User','user');
    }

    public function getName()
    {
        return $this->name;
    }


} 