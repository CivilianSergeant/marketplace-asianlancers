<?php

class DiscussionComments extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table = "discussion_comments";


    /**
     * @var array  only attributes that can be fill-able
     */
    protected $fillable = array('discussion_id','sender_id','receiver_id','message','type','read_status','attachment');

    public function Discussion()
    {
        return $this->belongsTo('Discussion','discussion_id','discussion_id');
    }

    public static function UnreadMessageCount($receiverId){
        return self::where('receiver_id',$receiverId)->where('type','Notification')->where('read_status',0)->count();
    }

    public static function AllMessageCount($receiverId=null){
        if($receiverId != null)
            return self::where('receiver_id',$receiverId)->where('type','Notification')->count();
        else
            return self::where('type','Notification')->count();
    }

    public function User()
    {
        return $this->belongsTo('User','sender_id','user_id');
    }
}
