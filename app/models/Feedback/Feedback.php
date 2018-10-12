<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:55 PM
 */

class Feedback extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="feedbacks";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('feedbacks_id','feedbacks_type','job_offer_id','feedback_status','feedback_score','feedback_visibility');



    public function feedbacks()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();
        static::created(function($feedback)
        {

            $user = Helpers::AdminToGeneralProfileAccess();

            if($feedback->feedbacks_type == 'Freelancer')
            {

                $freelancer = Freelancer::find($feedback->feedbacks_id);
                $jobOffer = JobOffer::find($feedback->job_offer_id);
                $client = Client::find($jobOffer->client_id);

            }else{

                $jobOffer = JobOffer::find($feedback->job_offer_id);
                $client = $jobOffer->Client;
                $freelancer = Freelancer::find($jobOffer->freelancer_id);
            }



            if(count($user) && $user->user_type == 'Client')
            {

                $msgbody = 'You get feedback from client <b>'.$client->getName().'</b>';
                $msgbody .= ' <br/>Visit job history link <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/freelancer/job-history'.'">http://'.FREELANCER_DOMAIN.'/freelancer/job-history'.'</a>';
                $data = array(
                    'sender_id'   => $user->user_id,
                    'sender_type'   => 'Client',
                    'receiver_id' => $freelancer->id,
                    'subject'     => 'Feedback from Client',
                    'message'     => $msgbody,
                    'url'         => 'notification',
                    'read_status' => 0,
                    'receiver_type' => 'Freelancer',
                    'notification_type' => 'Feedback',
                    'object_id'   => Helpers::EncodeDecode($feedback->job_offer_id)
                );



            }else if(count($user) && $user->user_type == 'Freelancer')
            {
                $msgbody = 'You get feedback from freelancer <b>'.$freelancer->getName().'</b>';
                $msgbody .= ' <br/>Visit job completed job link <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/complete-jobs'.'">http://'.CLIENT_DOMAIN.'/jobPost/complete-jobs'.'</a>';
                $data = array(
                    'sender_id'   => $user->user_id,
                    'sender_type'   => 'Freelancer',
                    'receiver_id' => $client->id,
                    'subject'     => 'Feedback from Freelancer',
                    'message'     => $msgbody,
                    'url'         => 'client/notification',
                    'read_status' => 0,
                    'receiver_type' => 'Client',
                    'notification_type' => 'Feedback',
                    'object_id'   => Helpers::EncodeDecode($feedback->job_offer_id)
                );
            }
            try{
                Notification::Persist($data);
            }catch(Exception $ex)
            {
              echo  $ex->getTraceAsString();
            }


        });

    }

    public static function Persist($postData)
    {
        if(!empty($postData['id'])){

        }else{
            $feedback = self::firstOrNew(array(
                'feedbacks_id'   => $postData['feedbacks_id'],
                'feedbacks_type' => $postData['feedbacks_type'],
                'job_offer_id'       => $postData['job_offer_id']
            ));

            if(!$feedback->exists)
            {
                $feedback->feedback_status = 'Locked';
                $feedback->feedback_score = $postData['feedback_score'];
                $feedback->feedback_visibility = 1;
                $feedback->comment = $postData['comment'];

                $feedback->save();
            }
            return $feedback;
        }
    }
} 