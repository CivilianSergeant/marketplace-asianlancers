<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:55 PM
 */

class Notification extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "notifications";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('sender_id','sender_type','receiver_id','subject','message','read_status','receiver_type','url','notification_type','object_id');

    /**
     * Polymorphic relation to Admin or Freelancer or Client
     * @return mixed
     */
    public function receiver()
    {
        return $this->morphTo();
    }

    public static function Persist($postData)
    {
        if(!empty($postData['id'])){
            $notification = self::find($postData['id']);

            if(!empty($postData['receiver_id']))
                $notification->receiver_id = $postData['receiver_id'];

            if(!empty($postData['subject']))
                $notification->subject = $postData['subject'];

            if(!empty($postData['receiver_type']))
                $notification->receiver_type = $postData['receiver_type'];

            if(!empty($postData['message']))
                $notification->message = $postData['message'];

            if(!empty($postData['read_status']))
                $notification->read_status = $postData['read_status'];

            if(!empty($postData['sender_id']))
                $notification->sender_id = $postData['sender_id'];

            if(!empty($postData['sender_type']))
                $notification->sender_type = $postData['sender_type'];

            if(!empty($postData['url']))
                $notification->url = $postData['url'];

            if(!empty($postData['notification_type']))
                $notification->notification_type = $postData['notification_type'];

            if(!empty($postData['object_id']))
                $notification->object_id = $postData['object_id'];

            $notification->save();
            return $notification;
        }else{
            $notification = new Notification();
            $notification->receiver_id = $postData['receiver_id'];
            $notification->subject = $postData['subject'];
            $notification->receiver_type = $postData['receiver_type'];
            $notification->message = $postData['message'];
            $notification->read_status = 0;
            $notification->sender_id = $postData['sender_id'];
            $notification->sender_type = $postData['sender_type'];
            $notification->url = $postData['url'];
            $notification->notification_type = $postData['notification_type'];
            $notification->object_id = $postData['object_id'];
            $notification->save();

            return $notification;
        }

    }
    public static function ReadFlag($postData)
    {
        $notification = self::find($postData['id']);
        if(!empty($postData['read_status']))
            $notification->read_status = $postData['read_status'];
        $notification->save();
    }
    public static function CountUnread($postData){
        return DB::table('notifications')->where(array('receiver_id'=>$postData['receiver_id'],'read_status'=>0,'receiver_type'=>$postData['receiver_type']))->count();
    }
} 