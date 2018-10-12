<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:41 PM
 */


class JobRequest extends Eloquent{


    public static $APPROVED = 'Approved';
    public static $ACCEPTED = 'Accepted';
    public static $REQUESTED = 'Requested';
    public static $CANCELED = 'Canceled';
    public static $DECLINED = 'Declined';

	/**
     * Table Name
     * @var string
     */
    protected $table="job_requests";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('freelancer_id','job_id','request_status');

    public static function boot()
    {
        parent::boot();
        static::created(function($jobRequest)
        {
            /*if(!empty($agencyMember->freelancer_id) && !empty($agencyMember->agency_id))
            {*/
            $freelancer = $jobRequest->Freelancer;
            $jobPost = $jobRequest->JobPost;

            /*$user = Sentry::findUserById(0);

            if(count($user) && $user->user_type == 'Admin')
            {*/
                $admins = Admin::all();
                if(count($admins))
                {
                    foreach($admins as $admin)
                    {
                        $msgbody = 'You get job request from freelancer <b>'.$freelancer->getName().'</b>';
                        $msgbody .= ' <br/>Visit job post link <a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a>';
                        $data = array(
                            'sender_id'   => $freelancer->id,
                            'sender_type'   => 'Freelancer',
                            'receiver_id' => $admin->id,
                            'subject'     => $jobPost->title,
                            'message'     => $msgbody,
                            'url'         => 'admin/job-request',
                            'read_status' => 0,
                            'receiver_type' => 'Admin',
                            'notification_type' => 'Job Request',
                            'object_id'   => Helpers::EncodeDecode($jobRequest->id)
                        );

                        Notification::Persist($data);

                       /* $emailBody  = 'Hi '.$admin->name.', <br/> "'.$jobPost->title.'" job was requested by "'.$freelancer->getName().' <br/>';
                        $emailBody .= 'Please click following link to see job details: <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPhase->JobOffer()->job_post_id).'">Here</a>';
*/
                        Email::SendNotification('emails.notification.jobrequest.admin',array(
                            'body'     => '',  
                            'name'     => $admin->name,
                            'email'    => $admin->email,
                            'freelancer_name' => $freelancer->getName(),
                            'title'    => 'Freelancer applied to - '.$jobPost->title,
                            'subject'  => 'Freelancer applied to - '.$jobPost->title,
                            'job_title' => 'Freelancer applied to - '.$jobPost->title,
                            'link' => 'http://'.CLIENT_DOMAIN.'/jobPost/request-jobs'
                        ));
                    }
                }

            /*}*/
            /*}*/
        });

        static::updated(function($jobRequest){
            
            $data = array(
                'url'         => 'client/job-request',
                'read_status' => 0,

                'notification_type' => 'Job Request',
                'object_id'   => Helpers::EncodeDecode($jobRequest->id)
            );
            $loggedUser = Helpers::AdminToGeneralProfileAccess();
            if(count($loggedUser) && $loggedUser->user_type=='Admin')
            {
                $data['sender_id'] = $loggedUser->user_id;
                $data['sender_type'] = 'Admin';
                $jobPost = $jobRequest->JobPost;
                if($jobRequest->request_status == 'Approved')
                {
                    $freelancer = $jobRequest->Freelancer;
                    $client = $jobRequest->JobPost->Client;
                    $msgbody = 'Hello, you have a job request review <br/>';
                    $msgbody .= '<strong>'.$freelancer->getName(). ' Want to work for this job <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a></strong>';
                    $data['receiver_id'] = $client->id;
                    $data['receiver_type'] = 'Client';
                    $data['subject']     = 'Job Request From '.$freelancer->getName();
                    $data['message']     = $msgbody;

                    Notification::Persist($data);

                    

                    Email::SendNotification('emails.notification.jobrequest.applied',array(
                            'body'     => '',  
                            'name'     => $client->first_name. ' '. $client->last_name,
                            'email'    => $client->email,
                            'freelancer_name' => $freelancer->getName(),
                            'title'    => 'Freelancer applied to - '.$jobPost->title,
                            'subject'  => 'Freelancer applied to - '.$jobPost->title,
                            'job_title' => 'Freelancer applied to - '.$jobPost->title,
                            'link' => 'http://'.CLIENT_DOMAIN.'/jobPost/request-jobs'
                        ));

                }else if($jobRequest->request_status == 'Canceled'){
                    $data['url'] = 'notification';
                    $freelancer = $jobRequest->Freelancer;
                    $jobPost = $jobRequest->JobPost;
                    $msgbody = 'Hello <strong>'.$freelancer->getName(). ', Administrator canceled your job request</strong>';
                    $data['receiver_id'] = $jobRequest->freelancer_id;
                    $data['receiver_type'] = 'Freelancer';
                    $data['subject']     = 'Your job request canceled';
                    $data['message']     = $msgbody;
                    Notification::Persist($data);

                    $emailBody  = 'Hi '.$freelancer->getName().', <br/> "'.$jobPost->title.'" job was canceled by Administrator <br/>';
                    $emailBody .= 'Please click following link to see job details: <a target="_blank" href="http://'.FREELANCER_DOMAIN.'/view/job/'.Heleprs::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobPost->id).'">Here</a>';

                    Email::SendNotification('emails.notification.jobrequest.canceled',array(
                            'body'     => '',  
                            'name'     => $freelancer->getName(),
                            'email'    => $freelancer->email,
                            'client'   => $client->first_name. ' '. $client->last_name,
                            'title'    => 'Job Application Cancelled - '.$jobPost->title,
                            'subject'  => 'Job Application Cancelled - '.$jobPost->title,
                            'job_title' => 'Job Application Cancelled - '.$jobPost->title,
                            'link' => 'http://'.FREELANCER_DOMAIN.'/freelancer/my-job-request'
                        ));
                }

            }elseif(count($loggedUser) && $loggedUser->user_type=='Client'){
                if($jobRequest->request_status == 'Declined'){
                    $data['url'] = 'notification';
                    $freelancer = $jobRequest->Freelancer;
                    $client = Client::find($loggedUser->user_id);
                    $data['sender_id'] = $loggedUser->user_id;
                    $data['sender_type'] = 'Client';
                    $msgbody = 'Hello <strong>'.$freelancer->getName(). ', job honour canceled your job request</strong>';
                    $data['receiver_id'] = $jobRequest->freelancer_id;
                    $data['receiver_type'] = 'Freelancer';
                    $data['subject']     = 'Your job request Declined';
                    $data['message']     = $msgbody;
                    Notification::Persist($data);

                    $emailBody  = 'Hi '.$freelancer->getName().', <br/> "'.$jobPost->title.'" job request was declined by "'.$client->first_name. ' '.$client->last_name.' <br/>';
                   

                    Email::SendNotification('emails.notification.jobrequest.declined',array(
                            'body'     => '',  
                            'name'     => $freelancer->getName(),
                            'email'    => $freelancer->email,
                            'client'   => $client->first_name. ' '. $client->last_name,
                            'title'    => 'Job Application Decliend By Client - '.$jobPost->title,
                            'subject'  => 'Job Application Decliend By Client - '.$jobPost->title,
                            'job_title' => 'Job Application Decliend By Client - '.$jobPost->title,
                            'link' => 'http://'.FREELANCER_DOMAIN.'/freelancer/my-job-request'
                        ));

                }

            }

        });


    }

	public static function Persist($postData)
    {

        if(!empty($postData['id']))
        {
            $jobRequest = self::find($postData['id']);
			if(!empty($postData['freelancer_id']))
				$jobRequest->freelancer_id = $postData['freelancer_id'];

            
			if(!empty($postData['job_id']))
				$jobRequest->job_id = $postData['job_id'];
			
			if(!empty($postData['request_status']))
				$jobRequest->request_status = $postData['request_status'];
			
            $jobRequest->save();

            return $jobRequest;
        }
        else
        {
            $jobRequest = self::firstOrNew(array(
                'freelancer_id' => $postData['freelancer_id'],
                'job_id' => $postData['job_id'],
                'request_status' => $postData['request_status']
            ));

            $jobRequest->save();

            return $jobRequest;
        }

    }


	
	public function JobPost()
    {
        return $this->belongsTo('JobPost','job_id','id');
    }
	
	public function Freelancer()
    {
        return $this->belongsTo('Freelancer','freelancer_id','id');
    }
} 