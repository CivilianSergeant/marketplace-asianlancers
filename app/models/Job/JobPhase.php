<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:41 PM
 */

class JobPhase extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="job_phases";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('job_offer_id','phase_title','phase_price','phase_hour','phase_payment_status','phase_start','phase_deadline','phase_details');

    public function JobOffer(){
        return $this->belongsTo('JobOffer', 'job_offer_id', 'id');
    }

    public static function Persist($postData)
    {
        if(!empty($postData['id']))
        {
            $jobPost = self::find($postData['id']);
            if(!empty($postData['job_offer_id']))
                $jobPost->job_offer_id = $postData['job_offer_id'];

            if(!empty($postData['phase_title']))
                $jobPost->phase_title = $postData['phase_title'];

            if(!empty($postData['phase_price']))
                $jobPost->phase_price = $postData['phase_price'];

            if(!empty($postData['phase_hour']))
                $jobPost->phase_hour = $postData['phase_hour'];

            if(!empty($postData['phase_payment_status']))
                $jobPost->phase_payment_status = $postData['phase_payment_status'];

            if(!empty($postData['phase_start']))
                $jobPost->phase_start = $postData['phase_start'];

            if(!empty($postData['phase_deadline']))
                $jobPost->phase_deadline = $postData['phase_deadline'];

            if(!empty($postData['phase_details']))
                $jobPost->phase_details = $postData['phase_details'];

            $jobPost->save();

            return $jobPost;
        }
        else
        {
            $jobPost = self::firstOrNew(array(
                'job_offer_id' => $postData['job_offer_id'],
                'phase_title' => $postData['phase_title'],
                'phase_price' => $postData['phase_price'],
                'phase_hour' => $postData['phase_hour'],
                'phase_payment_status' => $postData['phase_payment_status'],
                'phase_start' => $postData['phase_start'],
                'phase_deadline' => $postData['phase_deadline'],
                'phase_details' => $postData['phase_details'],
            ));
            $jobPost->save();

            return $jobPost;
        }

    }
    public static function boot()
    {
        parent::boot();

        static::created(function($jobPhase){
            if($jobPhase->phase_payment_status == 'Pending'){
                self::pendingPhaseFreelancer($jobPhase);
            }
        });

        static::updating(function($jobPhase){
            if($jobPhase->phase_payment_status == 'Waiting'){
                self::waitingPhaseClient($jobPhase);
            }elseif($jobPhase->phase_payment_status == 'Progress'){
                self::progressPhaseClient($jobPhase);
                self::progressJobOffer($jobPhase);
            }elseif($jobPhase->phase_payment_status == 'Hold'){
                self::holdPhaseFreelancer($jobPhase);
            }if($jobPhase->phase_payment_status == 'Done'){
//                self::donePhaseClient($jobPhase);
            }
        });
    }

    private static function progressJobOffer($jobPhase){
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
//        Helpers::debug($jobOffer,1);
        if($jobOffer->job_offer_status == 'Accepted'){
            JobOffer::Persist(array('id'=>$jobOffer->id,'job_offer_status'=>'Progress'));
        }
    }

    private static function progressPhaseClient($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'client/phase-progress',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Phase',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $jobPost = JobPost::find($jobOffer->job_post_id);
        $msgbody = '<strong><a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/freelancer/'.Helpers::EncodeDecode($freelancer->id).'">'.$freelancer->first_name. ' '. $freelancer->last_name. '</a>
                has been started your phase.</strong> Please click following link to read job details:<br/>
                <a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">'.$jobOffer->title.'</a>';
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Phase Progress';
        $data['message']     = $msgbody;
//        Helpers::debug($data,1);
        Notification::Persist($data);

        $emailBody  = 'Hi '.$client->first_name. ' '.$client->last_name.', <br/> Status of Job Phase "'.$jobPhase->phase_title.'" has been Updated by '.$freelancer->getName().' <br/>';
        $emailBody .= 'Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">Here</a>';

        Email::SendNotification('emails.notification.jobphase.created',array(
            'body'     => '',  
            'name'     => $client->first_name. ' ' .$client->last_name,
            'email'    => $client->email,
            'title'    => 'Job Phase updated - '.$jobOffer->title,
            'subject'  => 'Job Phase updated  - '.$jobOffer->title,
            'jobTitle' => 'Job Phase updated - '.$jobOffer->title,
        ));
    }

    private static function donePhaseClient($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'payment-process',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Payment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $msgbody = '';
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Payment process';
        $data['message']     = $msgbody;

        Notification::Persist($data);

        $emailBody  = 'Hi '.$client->first_name. ' '.$client->last_name.', <br/> Job Phase "'.$jobPhase->phase_title.'" has been done by '.$freelancer->getName().' <br/>';
        $emailBody .= 'You are asked for the payment for this work phase. Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">Here</a>';

        Email::SendNotification('JobPhase',array(
            'body'     => $emailBody,  
            'name'     => $client->first_name. ' ' .$client->last_name,
            'email'    => $client->email,
            'title'    => 'Payment requested - '.$jobOffer->title,
            'subject'  => 'Payment requested - '.$jobOffer->title,
            'jobTitle' => 'Payment requested - '.$jobOffer->title,
        ));
    }

    private static function donePhaseFreelancer($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'payment-process',
            'read_status' => 0,
            'receiver_type' => 'Freelancer',
            'notification_type' => 'Payment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $jobPost = JobPost::find($jobOffer->job_post_id);
        $msgbody = '<strong><a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/client/'.Helpers::EncodeDecode($client->id).'">'.$client->first_name. ' '. $client->last_name. '</a>
                has been open your payment.</strong><br/>Please click following link to read job details and accept job invitation:<br/>
                <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">'.$jobOffer->title.'</a>';
        $data['receiver_id'] = $freelancer->id;
        $data['subject']     = 'Payment process';
        $data['message']     = $msgbody;

        Notification::Persist($data);

        $emailBody  = 'Hi '.$freelancer->getName().', <br/> Job Phase "'.$jobPhase->phase_title.'" has been done by '.$client->first_name. ' '.$client->last_name.' <br/>';
        $emailBody .= 'You are asked for the payment for this work phase. Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">Here</a>';

        Email::SendNotification('JobPhase',array(
            'body'     => $emailBody,  
            'name'     => $freelancer->getName(),
            'email'    => $freelancer->email,
            'title'    => 'Payment requested - '.$jobOffer->title,
            'subject'  => 'Payment requested - '.$jobOffer->title,
            'jobTitle' => 'Payment requested - '.$jobOffer->title,
        ));
    }

    private static function pendingPhaseFreelancer($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'notification',
            'read_status' => 0,
            'receiver_type' => 'Freelancer',
            'notification_type' => 'Phase',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $jobPost = JobPost::find($jobOffer->job_post_id);
        $msgbody = '<strong><a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/client/'.Helpers::EncodeDecode($client->id).'">'.$client->first_name. ' '. $client->last_name. '</a>
                has been created phase.</strong><br/>Please click following link to read job details:<br/>
                <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">'.$jobOffer->title.'</a>';
        $data['receiver_id'] = $freelancer->id;
        $data['subject']     = 'New Phase';
        $data['message']     = $msgbody;

        Notification::Persist($data);

        $emailBody  = 'Hi '.$freelancer->getName().', <br/> a new phase assigned to you for job offer '.$jobOffer->title.' <br/>';
        $emailBody .= 'Please click following link to see job details: <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">Here</a>';

        Email::SendNotification('emails.notification.jobphase.created',array(
            'body'     => '',  
            'name'     => $client->first_name. ' '. $client->last_name,
            'email'    => $client->email,
            'title'    => 'Job Phase created - '.$jobOffer->title,
            'subject'  => 'Job Phase created - '.$jobOffer->title,
            'job_phase_title' => $jobPhase->phase_title,
            'freelancer_name' => $freelancer->getName()
        ));

        Email::SendNotification('emails.notification.jobphase.delivered',array(
            'body'     => '',  
            'name'     => $freelancer->getName(),
            'email'    => $freelancer->email,
            'title'    => 'Job Phase assigned - '.$jobPhase->phase_title,
            'subject'  => 'Job Phase assigned - '.$jobPhase->phase_title,
            'job_phase_title' => $jobPhase->phase_title,
            'job_offer_title' => $jobOffer->title
        ));
    }

    private static function donePhaseAdmin($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'payment-process',
            'read_status' => 0,
            'receiver_type' => 'Admin',
            'notification_type' => 'Payment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $msgbody = '<strong>Your job offer has been approved.</strong><br/>Please click following link to see job details:<br/>
                <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">'.$jobPhase->JobOffer()->title.'</a>';
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Payment requested';
        $data['message']     = $msgbody;

        Notification::Persist($data);

        $emailBody  = 'Hi '.$client->first_name. ' '.$client->last_name.', <br/> Job Phase "'.$jobPhase->phase_title.'" has been done by '.$freelancer->getName().' <br/>';
        $emailBody .= 'You are asked for the payment for this work phase. Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">Here</a>';

        Email::SendNotification('emails.notification.jobphase.done',array(
            'body'     => '',  
            'name'     => $client->first_name. ' ' .$client->last_name,
            'email'    => $client->email,
            'title'    => 'Payment requested - '.$jobPhase->phase_title,
            'subject'  => 'Payment requested - '.$jobPhase->phase_title,
            'freelancer' => $freelancer->getName(),
            'job_phase_title' => $jobPhase->phase_title,
        ));
    }

    private static function waitingPhaseClient($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'client/payment-process',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Payment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $msgbody = 'This freelancer has been completed phase.';
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Payment Process';
        $data['message']     = $msgbody;

        Notification::Persist($data);
        $emailBody  = 'Hi '.$client->first_name. ' '.$client->last_name.', <br/> Job Phase "'.$jobPhase->phase_title.'" has been done by '.$freelancer->getName().' <br/>';
        $emailBody .= 'You are asked for the payment for this work phase. Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">Here</a>';

        /* Email::SendNotification('emails.notification.jobphase.done',array(
            'body'     => '',  
            'name'     => $client->first_name. ' ' .$client->last_name,
            'email'    => $client->email,
            'title'    => 'Payment requested - '.$jobPhase->phase_title,
            'subject'  => 'Payment requested - '.$jobPhase->phase_title,
            'freelancer' => $freelancer->getName(),
            'job_phase_title' => $jobPhase->phase_title,
        ));*/
    }
    private static function holdPhaseFreelancer($jobPhase){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'notification',
            'read_status' => 0,
            'receiver_type' => 'Freelancer',
            'notification_type' => 'Payment',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPhase->id)
        );
        $jobOffer = JobOffer::find($jobPhase->job_offer_id);
        $freelancer = $jobOffer->Freelancer;
        $client = Client::find($jobOffer->client_id);
        $msgbody = 'Your payment process hold by <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/client/'.Helpers::EncodeDecode($client->id).'">'.$client->first_name. ' '. $client->last_name. '</a>';
        $data['receiver_id'] = $freelancer->id;
        $data['subject']     = 'Payment Process Hold';
        $data['message']     = $msgbody;

        Notification::Persist($data);

        $emailBody  = 'Hi '.$freelancer->getName().', <br/> Payment of Job Phase "'.$jobPhase->phase_title.'" has been hold by '.$client->first_name. ' '. $client->last_name.' <br/>';
        $emailBody .= 'Please click following link to see job details: <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobOffer->job_post_id).'">Here</a>';

         Email::SendNotification('emails.notification.jobphase.done',array(
            'body'     => '',  
            'name'     => $freelancer->getName(),
            'email'    => $client->email,
            'title'    => 'Payment on hold - '.$jobPhase->phase_title,
            'subject'  => 'Payment on hold - '.$jobPhase->phase_title,
            'client' => $client->first_name. ' ' .$client->last_name,
            'job_phase_title' => $jobPhase->phase_title,
        ));
    }

} 