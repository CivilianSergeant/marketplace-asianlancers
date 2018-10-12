<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 7/8/14
 * Time: 3:22 PM
 */

class Discussion extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table = "discussions";

    /**
     * @var array  only attributes that can be fill-able
     */
    protected $fillable = array('subject','details','sender_id','status','attachment','receivers');

    public function Comments()
    {
        return $this->hasMany('DiscussionComments','discussion_id','id')->where('type','Comment');
    }

    public function Users($users)
    {
        $userNames = array();
        $users = explode(",",$users);
        foreach($users as $user)
        {

            $userObj = User::where('user_id',$user)->first();

            $userNames[] = $userObj->first_name.' '.$userObj->last_name;
        }
        return $userNames;
    }

} 