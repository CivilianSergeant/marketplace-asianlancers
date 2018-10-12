<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 1:36 PM
 */

class JobPhaseController extends BaseController{

	protected $loginUser;

    public function __construct()
    {
        parent::__construct();
		$this->loginUser = Sentry::getUser();
    }

    public function index()
    {
        return Redirect::to('jobPhase/list');
    }

    public function Add(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();			
			
            $errorMsg =  JobPhaseValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
//			Helpers::debug($errorMsg);
//            Helpers::debug($post_data,1);
            if($post_data['phase_payment_status']=='Done')
                $post_data['phase_payment_status']='Waiting';
           // Helpers::debug($post_data,1);
            $jobPhase = JobPhase::Persist($post_data);
            if(!empty($jobPhase) && !empty($jobPhase->id))
            {
                $jobPhase['code'] = Helpers::EncodeDecode($jobPhase->id);
                return array(
                    'status'=>'200',
                    'msg'=>array(array('Job Phase has been submitted successfully.')),
                    'newData' => $jobPhase
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Phase has not been saved.')));
            }
        }else{
            return Redirect::to('/');
        }
        exit();
    }

    public function AllPhase(){
        if(Request::isMethod('post'))
        {
            $viewModel = array();
            $post_data = Input::all();
            $job_id = Helpers::EncodeDecode($post_data['code'],false);
            $jobOfferAllPhase = JobOffer::with('JobPhase')->where(array('job_post_id'=>$job_id))->get();
//            Helpers::debug($jobOfferAllPhase,1);
            $viewModel['jobOfferAllPhase'] = $jobOfferAllPhase;
            return Theme::make('job.all-phase',$viewModel);
        }else{
            return Redirect::to('/');
        }
    }
} 