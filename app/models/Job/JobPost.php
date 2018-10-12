<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:41 PM
 */
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobPost extends Eloquent {

    use SoftDeletingTrait;

    /**
     * Table name
     * @var string
     */
    protected $table = "job_posts";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('client_id','job_category_id','title','description','hour','job_price_range');


    public static function Persist($postData)
    {
        if(!empty($postData['id']))
        {

            $jobPost = self::find($postData['id']);
			if(!empty($postData['job_category_id']))
				$jobPost->job_category_id = $postData['job_category_id'];
				
			if(!empty($postData['client_id']))
				$jobPost->client_id = $postData['client_id'];

            if(!empty($postData['title']))
                $jobPost->title = $postData['title'];
				
			if(!empty($postData['description']))
				$jobPost->description = $postData['description'];
				
			if(!empty($postData['amount']))
				$jobPost->amount = $postData['amount'];

            if(!empty($postData['hour']))
                $jobPost->hour = $postData['hour'];

            if(!empty($postData['job_status']))
                $jobPost->job_status = $postData['job_status'];

            if(!empty($postData['job_price_range']))
                $jobPost->job_price_range = $postData['job_price_range'];

            $jobPost->save();

            return $jobPost;
        }
        else
        {
            $jobPost = self::firstOrNew(array(
                'client_id' => $postData['client_id'],
                'job_category_id' => $postData['job_category_id'],
                'title' => $postData['title'],
                'description' => $postData['description'],
                'job_price_range' => $postData['job_price_range'],
                'hour' => $postData['hour']
            ));
            $jobPost->attach_file = json_encode($postData['attach_file'],JSON_FORCE_OBJECT);
            $jobPost->job_status = $postData['job_status'];

            $jobPost->save();

            return $jobPost;
        }

    }
	
	public static function UpdateAttachFile($data,$fileName){
		$jobPost = self::find($data['id']);
		if(!empty($jobPost)){
			$fileNames = json_decode($jobPost->attach_file,true);
			$tmpNames = array_merge($fileNames,$fileName);
			$jobPost->attach_file = json_encode(array_merge($fileNames,$fileName),JSON_FORCE_OBJECT);
			$jobPost->save();
		}		
		return $jobPost->attach_file;
	}
	
	public static function DeleteFile($data){
		$jobPost = self::find(Helpers::EncodeDecode($data['id'],false));
		$fileNames = json_decode($jobPost->attach_file,true);
		$tmpNames = array_diff($fileNames, array($data['file_name']));
//        Helpers::debug($tmpNames,1);
		$jobPost->attach_file = json_encode(array_merge($tmpNames,array()),JSON_FORCE_OBJECT);
        $jobPost->save();
		
		return $jobPost->attach_file;
	}

    public function AssignTag(JobPost $jobPost, $skillTag)
    {
        foreach($skillTag as $skill){
            $relatedTag = RelatedTag::firstOrNew(array(
                'relatedentity_id'  => $jobPost->id,
                'relatedentity_type' => 'JobPost',
                'skill_tags_id'       => $skill,
                'display'            => 1,
            ));

            if(!$relatedTag->exists)
            {
                $relatedTag->save();
            }
        }
    }

    public function GetMyTagsForSelect2()
    {
        $relatedTags = $this->RelatedTags;

        foreach($relatedTags as $i=> $rt)
        {
            $relatedTags[$i]['id'] = $rt->GetTag->id;
			$relatedTags[$i]['text'] = $rt->GetTag->category_name;
        }
        return $relatedTags;
    }

    public function GetMyTags()
    {
        $relatedTags = $this->RelatedTags;
        foreach($relatedTags as $i=> $rt)
        {
            $relatedTags[$i]['id'] = $rt->GetTag->id;
            $relatedTags[$i]['name'] = $rt->GetTag->category_name;
        }
        return $relatedTags;
    }

	public function DeleteMyTags()
    {
        $relatedTags = $this->RelatedTags;
		if(!empty($relatedTags))
			$this->RelatedTags()->delete();
	}
    public function RelatedTags()
    {
        return $this->morphMany('RelatedTag','relatedentity');
    }

    public function JobCategory()
    {
        return $this->belongsTo('JobCategory','job_category_id','id');
    }
    public function JobRequest()
    {
        return $this->hasMany('JobRequest','job_id','id')->where('request_status','!=','Accepted');
    }
    public function Client()
    {
        return $this->belongsTo('Client','client_id','id');
    }
	public function JobOffer()
    {
        return $this->hasMany('JobOffer','job_post_id','id');
    }

    public static function TotalAmountJobPost($id){
        return DB::table('job_offers')->where(array('job_post_id'=> $id))->whereIn('job_offer_status',array('Pending','Approved','Accepted','Paused'))->sum('job_offer_price');
    }
    public static function TotalHourJobPost($id){
        return DB::table('job_offers')->where(array('job_post_id'=> $id))->whereIn('job_offer_status',array('Pending','Approved','Accepted','Paused'))->sum('job_offer_hour');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($jobPost){
            $loggedUser = Helpers::AdminToGeneralProfileAccess();

            if($jobPost->job_status == 'Pending'){
                self::pendingAdmin($jobPost);
            }elseif($jobPost->job_status == 'Approved'){
                self::approveClient($jobPost,$loggedUser);
            }
        });
        static::updating(function($jobPost){
            $att = $jobPost->getAttributes();
            $ori_att = $jobPost->getOriginal();
            $loggedUser = Helpers::AdminToGeneralProfileAccess();

            if($att['job_status']!=$ori_att['job_status']){
                if($jobPost->job_status == 'Approved'){
                    self::approveClient($jobPost,$loggedUser);
                }else if($jobPost->job_status == 'Canceled'){
                    $jobOffers = JobOffer::where(array('job_post_id'=>$jobPost->id))->get();
                    if(count($jobOffers)>0){
                        foreach($jobOffers as $jobOffer){
                            $jobOffer->job_offer_status="Canceled";
                            $jobOffer->save();
                        }
                    }
                    self::cancelClient($jobPost);
                }elseif($jobPost->job_status == 'Completed'){
                    //self::approveClient($jobPost,$loggedUser);
                }
            }
        });
    }

    private static function pendingAdmin($jobPost){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'admin/new-job',
            'read_status' => 0,
            'receiver_type' => 'Admin',
            'notification_type' => 'Job Post',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPost->id)
        );
        $jobPost = JobPost::find($jobPost->id);
        $client = Client::find($jobPost->client_id);
        $admins = Admin::all();
        if(count($admins))
        {
            foreach($admins as $admin)
            {
                $admin = Admin::find($admin->id);
                $msgbody = '<strong><a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/client/'.Helpers::EncodeDecode($client->id).'">'.$client->first_name. ' '. $client->last_name. '</a> has been created a new job.
                            </strong><br/>Please click following link to read job details and approve job:<br/>
                        <a target="_blank" href="http://'.CLIENT_DOMAIN.'/view/job/'.Helpers::EncodeDecode($jobPost->job_category_id).'/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a>';
                $data['receiver_id'] = $admin->id;
                $data['subject']     = 'New Job';
                $data['message']     = $msgbody;
                $notification = Notification::Persist($data);
                Email::SendNotification('emails.notification.job-post-admin',array(
                    'body'     => $client->first_name. ' '.$client->last_name . ' has been created a job "'.$jobPost->title.'" Please click following link to read job details and approve job:<br/> <a target="_blank" href="http://'.CLIENT_DOMAIN.'/admin/new-job/'.Helpers::EncodeDecode($notification->id).'">'.$jobPost->title.'</a>',
                    'link'     => 'http://'.CLIENT_DOMAIN.'/admin/new-job/'.Helpers::EncodeDecode($notification->id),
                    'name'     => 'Administrator',
                    'email'    => $admin->email,
                    'title'    => $jobPost->title,
                    'subject'  => 'New Job Posted - '. $jobPost->title,
                    'jobTitle' => $jobPost->title.' Job Posted by '.$client->first_name. ' '. $client->last_name
                ));
            }
        }

        // for client

        Email::SendNotification('emails.notification.jobpost.created',array(
            'name'         => $client->first_name.' '.$client->last_name,
            'link'         => 'http://'.CLIENT_DOMAIN.'/jobPost/new-jobs',
            'email'        => $client->email,
            'title'        => $jobPost->title,
            'subject'      => 'New Job Posted - '. $jobPost->title,
            'job_title'    => $jobPost->title,
            'job_category' => $jobPost->JobCategory->title
        ));
    }

    private static function cancelClient($jobPost){
        $loggedUser = Helpers::AdminToGeneralProfileAccess();
        $data = array(
            'url'         => 'notification/view',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Job Post',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPost->id)
        );
        $client = Client::find($jobPost->client_id);
        $msgbody = '<strong>Your job has been canceled.</strong><br/>Please click following link to see job details:<br/>
                <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a><br/><br/>
                If you need any query then please contact with support team.';
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Job Canceled';
        $data['message']     = $msgbody;

        Notification::Persist($data);
        Email::SendNotification('JobPost',array(
                    'body'  => 'Hi, '.$client->first_name. ' '.$client->last_name.' Your created job "'.$jobPost->title.'" has been canceled by Administrator',
                    'name'     => $client->first_name. ' ' .$client->last_name,
                    'email'    => $client->email,
                    'title'    => $jobPost->title,
                    'subject'  => 'Job Post Canceled - '. $jobPost->title,
                    'jobTitle' => 'Job Post Canceled - '. $jobPost->title
                ));
    }

    private static function approveClient($jobPost,$loggedUser){

        $data = array(
            'url'         => 'notification/view',
            'read_status' => 0,
            'receiver_type' => 'Client',
            'notification_type' => 'Job Post',
            'sender_id' => $loggedUser->user_id,
            'sender_type' => $loggedUser->user_type,
            'object_id'   => Helpers::EncodeDecode($jobPost->id)
        );
        $client = Client::find($jobPost->client_id);
        $admin = Admin::find($loggedUser->user_id);
        if($loggedUser->user_type=='Admin'){
            $msgbody = '<strong><a href="#">'.$admin->name.'</a> has been assigned a job on you.</strong><br/>Please click following link to see job details:<br/>
                    <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a>';
        }elseif($loggedUser->user_type=='Client'){
            $msgbody = '<strong>Your job has been approved.</strong><br/>Please click following link to see job details:<br/>
                    <a target="_blank" href="http://'.CLIENT_DOMAIN.'/jobPost/view/'.Helpers::EncodeDecode($jobPost->id).'">'.$jobPost->title.'</a>';
        }
        $data['receiver_id'] = $client->id;
        $data['subject']     = 'Job Approved';
        $data['message']     = $msgbody;

        Notification::Persist($data);
        Email::SendNotification('emails.notification.jobpost.approved',array(
            'name'         => $client->first_name.' '.$client->last_name,
            'link'         => 'http://'.CLIENT_DOMAIN.'/jobPost/new-jobs',
            'email'        => $client->email,
            'title'        => $jobPost->title,
            'subject'      => 'Job Post Verified - '. $jobPost->title,
            'job_title'    => $jobPost->title,
            'job_category' => $jobPost->JobCategory->title
        ));
    }
} 