<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 1:36 PM
 */

class JobOfferController extends BaseController{

	protected $loginUser;

    public function __construct()
    {
        parent::__construct();
		$this->loginUser = Sentry::getUser();
    }

    public function index()
    {
        return Redirect::to('jobOffer/list');
    }

    public function Add(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();			
			
            $errorMsg =  JobOfferValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
//			Helpers::debug($errorMsg);
//            Helpers::debug($post_data,1);
            $jobPost = JobPost::find($post_data['job_post_id']);
			$post_data['client_id'] = ($this->loginUser->user_type=='Admin')?$jobPost->client_id:$this->loginUser->user_id;
            $post_data['job_offer_status'] = 'Pending';
            $post_data['job_offer_status_reason'] = 'Client request you to accept his/her job offer';
            //var_dump($this->loginUser->getattributes());
			//die();
            $jobOffer = JobOffer::Persist($post_data);
            if(!empty($jobOffer) && !empty($jobOffer->id))
            {
                $jobOffer['code'] = Helpers::EncodeDecode($jobOffer->id);
                $jobOffer['freelancer'] = $jobOffer->Freelancer;
                $jobOffer['job_phase'] = $jobOffer->JobPhase;
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Job Offer has been submitted successfully.')),
                    'newData' => $jobOffer
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Offer has not been saved.')));
            }
        }else{
            return Redirect::to('/');
        }
    }
    public function Update(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();

            $errorMsg =  JobOfferValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
//			Helpers::debug($errorMsg);
//            Helpers::debug($post_data,1);
//            if($this->loginUser->user_type=="Client")
//                $post_data['client_id'] = $this->loginUser->getattribute('user_id');

            //var_dump($this->loginUser->getattributes());
            //die();
            $jobOffer = JobOffer::Persist($post_data);
            if(!empty($jobOffer) && !empty($jobOffer->id))
            {
                $jobOffer['code'] = Helpers::EncodeDecode($jobOffer->id);
                $jobOffer['freelancer'] = $jobOffer->Freelancer;
                $jobOffer['job_phase'] = $jobOffer->JobPhase;
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Job Offer has been updated successfully.')),
                    'newData' => $jobOffer
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Offer has not been saved.')));
            }
        }else{
            return Redirect::to('/');
        }
    }

    public function statusUpdate(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();

            $errorMsg =  JobOfferValidator::statusValidate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
            $jobOffer = JobOffer::find($post_data['id']);
            if($post_data['job_offer_status']=='Approved'){
                JobPost::Persist(array('id'=>$jobOffer->job_post_id,'job_status'=>'Approved'));
            }
            elseif($post_data['job_offer_status']=='Accepted'){
                JobPost::Persist(array('id'=>$jobOffer->job_post_id,'job_status'=>'Progress'));
//                $post_data['job_offer_status'] = 'Progress';
//                Freelancer::AvailableStatus(array('id'=>$jobOffer->freelancer_id,'available'=>0));
            }

            $jobOffer = JobOffer::Persist($post_data);
            if(!empty($jobOffer) && !empty($jobOffer->id))
            {
                $jobOffer = JobOffer::find($post_data['id']);
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Job Offer status has been updated successfully.')),
                    'newData' => $jobOffer
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Offer has not been saved.')));
            }
        }else{
            return Redirect::to('/');
        }
    }

    public function NewJobOffer(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();

            $errorMsg =  JobOfferValidator::newOfferValidate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
            $jobPost = JobPost::find($post_data['job_post_id']);
//            $freelancer = Freelancer::find(Helpers::EncodeDecode($post_data['freelancer_id'],false));
            $freelancer = Freelancer::find($post_data['freelancer_id']);
            $joFreelancer = JobOffer::where(array(
                'job_post_id'=>$post_data['job_post_id'],
                'freelancer_id'=>$freelancer->id
            ))->whereIn('job_offer_status',array('Canceled','Declined'))->get();
//            Helpers::debug($post_data,1);

            if(count($joFreelancer)==0){
                $post_data['client_id'] = ($this->loginUser->user_type=='Admin')?$jobPost->client_id:$this->loginUser->user_id;
                $post_data['freelancer_id'] = $post_data['freelancer_id'];
                if($this->loginUser->user_type=='Admin')
                    $post_data['job_offer_status'] = 'Approved';
                elseif($this->loginUser->user_type=='Client')
                    $post_data['job_offer_status'] = 'Pending';

                $post_data['job_offer_status_reason'] = 'Client request you to accept his/her job offer';
                $job_price_range = explode(',',$jobPost->job_price_range);
                if(array_search($freelancer->freelancer_price,$job_price_range)===false)
                    $jobPost->job_price_range = $jobPost->job_price_range.','.$freelancer->freelancer_price;
//                $jobPost->amount = $jobPost->amount+$post_data['job_offer_price'];
//                $jobPost->hour = $jobPost->hour+$post_data['job_offer_hour'];

                $jobPost = JobPost::Persist(array(
                                            'id'=>$post_data['job_post_id'],
//                                            'amount'=>$jobPost->amount,
//                                            'hour'=>$jobPost->hour,
                                            'job_price_range'=>$jobPost->job_price_range
                            ));
            }else{
                $post_data['id'] = $joFreelancer[0]->id;
                $post_data['client_id'] = ($this->loginUser->user_type=='Admin')?$jobPost->client_id:$this->loginUser->user_id;
                $post_data['freelancer_id'] = $post_data['freelancer_id'];
                if($this->loginUser->user_type=='Admin')
                    $post_data['job_offer_status'] = 'Approved';
                elseif($this->loginUser->user_type=='Client')
                    $post_data['job_offer_status'] = 'Pending';
                $post_data['job_offer_status_reason'] = 'Client request you to accept his/her job offer';
            }
            $jobOffer = JobOffer::Persist($post_data);
            if(!empty($jobOffer) && !empty($jobOffer->id))
            {
                $jobOffer['code'] = Helpers::EncodeDecode($jobOffer->id);
                $jobOffer['freelancer'] = $jobOffer->Freelancer;
                $jobOffer['job_phase'] = $jobOffer->JobPhase;
                $dataFlag = "new";
                if(count($joFreelancer)>0)
                    $dataFlag = 'old';
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Job Offer has been submitted successfully.')),
                    'newData' => $jobOffer,
                    'dataFlag' => $dataFlag
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Offer has not been saved.')));
            }
        }else{
            return Redirect::to('/');
        }
    }
    public function AddComment(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $post_data['honour_id'] = $this->loginUser->user_id;
            $post_data['honour_type'] = $this->loginUser->user_type;
            $comment = Comment::Persist($post_data);
            if(!empty($comment) && !empty($comment->id))
            {
                $comment['client'] = $comment->honour;
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Comment has been submitted successfully.')),
                    'newData' => $comment
                );
            }
        }else{
            return Redirect::to('/');
        }
    }
} 