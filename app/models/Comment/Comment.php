<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:55 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Comment extends Eloquent{

    use SoftDeletingTrait;

    /**
     * Table Name
     * @var string
     */
    protected $table="comments";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('jobthread_id','jobthread_type');

    public static function Persist($postData)
    {
        if(!empty($postData['id'])){
            $comment = self::find($postData['id']);
            if(!empty($postData['jobthread_id']))
                $comment->jobthread_id = $postData['jobthread_id'];

            if(!empty($postData['jobthread_type']))
                $comment->jobthread_type = $postData['jobthread_type'];

            if(!empty($postData['message']))
                $comment->message = $postData['message'];

            if(!empty($postData['honour_id']))
                $comment->honour_id = $postData['honour_id'];

            if(!empty($postData['honour_type']))
                $comment->honour_type = $postData['honour_type'];

            $comment->save();

            return $comment;
        }
        else{
            $comment = new Comment();
            if(!empty($postData['jobthread_id']))
                $comment->jobthread_id = $postData['jobthread_id'];

            if(!empty($postData['jobthread_type']))
                $comment->jobthread_type = $postData['jobthread_type'];

            if(!empty($postData['message']))
                $comment->message = $postData['message'];

            if(!empty($postData['honour_id']))
                $comment->honour_id = $postData['honour_id'];

            if(!empty($postData['honour_type']))
                $comment->honour_type = $postData['honour_type'];

            $comment->save();

            return $comment;
        }
    }

    public function jobthread()
    {
        return $this->morphTo();
    }
    public function honour()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($comment){
            $loggedUser = Helpers::AdminToGeneralProfileAccess();

            if($loggedUser->user_type == 'Admin'){
                self::newCommentClient($comment,$loggedUser);
                self::newCommentFreelancer($comment,$loggedUser);
            }elseif($loggedUser->user_type == 'Freelancer'){
                self::newCommentClient($comment,$loggedUser);
            }elseif($loggedUser->user_type == 'Client'){
                self::newCommentFreelancer($comment,$loggedUser);
            }
        });
    }

    private static function newCommentClient($comment,$loggedUser){
        $data = array(
            'url'         => 'client/notification',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Comment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($comment->id)
        );
        $commentCreator = array();
        $name = "";
        if($loggedUser->user_type == 'Admin'){
            $commentCreator = Admin::find($comment->honour_id);
            $name = $commentCreator->name;
        }elseif($loggedUser->user_type == 'Freelancer'){
            $commentCreator = Freelancer::find($comment->honour_id);
            $name = $commentCreator->first_name.' '.$commentCreator->last_name;
        }
        $jobthread = array();
        $receiver = array();
        if($comment->jobthread_type=='JobOffer'){
            $jobthread = JobOffer::find($comment->jobthread_id);
            $receiver = Client::find($jobthread->client_id);
            $jobPost = JobPost::find($jobthread->job_post_id);
        }

        $msgbody = '<p>"'.$comment->message.'"</p><strong>'.$name.'</strong> has been created above comment on following job:<br/>
                <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a><br/><br/>';
        $data['receiver_id'] = $receiver->id;
        $data['subject']     = 'New Comment';
        $data['message']     = $msgbody;

        Notification::Persist($data);
    }

    private static function newCommentFreelancer($comment,$loggedUser){
        $data = array(
            'url'         => 'notification',
            'read_status' => 0,
            'receiver_type' => 'Freelancer',
            'notification_type' => 'Comment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($comment->id)
        );
        $commentCreator = array();
        $name = "";
        if($loggedUser->user_type == 'Admin'){
            $commentCreator = Admin::find($comment->honour_id);
            $name = $commentCreator->name;
        }elseif($loggedUser->user_type == 'Client'){
            $commentCreator = Client::find($comment->honour_id);
            $name = $commentCreator->first_name.' '.$commentCreator->last_name;
        }
        $jobthread = array();
        $receiver = array();
        if($comment->jobthread_type=='JobOffer'){
            $jobthread = JobOffer::find($comment->jobthread_id);
            $receiver = Freelancer::find($jobthread->freelancer_id);
            $jobPost = JobPost::find($jobthread->job_post_id);
        }

        $msgbody = '<p>"'.$comment->message.'"</p><strong>'.$name.'</strong> has been created above comment on following job:<br/>
                <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a><br/><br/>';
        $data['receiver_id'] = $receiver->id;
        $data['subject']     = 'New Comment';
        $data['message']     = $msgbody;

        Notification::Persist($data);
    }
}