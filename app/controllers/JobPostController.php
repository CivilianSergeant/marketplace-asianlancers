<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 1:36 PM
 */

class JobPostController extends BaseController{

	protected $loginUser;
    protected $user_id;

    public function __construct()
    {
//        parent::__construct();
//		$this->loginUser = Sentry::getUser();
        parent::__construct();
        $loggedUser = Helpers::AdminToGeneralProfileAccess();//Sentry::getUser();

        $this->loginUser = $loggedUser;

        $this->user_id = $this->loginUser->user_id;

        View::share('authenticateUserInfo',$loggedUser);
        if($this->loginUser->user_type=='Client')
            $client = Client::find($this->user_id);
        else
            $client = Sentry::getUser();
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
        View::share('notifications',(count($client))? $client->UnreadNotifications : array());
    }

    public function index()
    {		
        if($this->loginUser->user_type=="Admin")
            return Redirect::to('jobPost/all-jobs');
        elseif($this->loginUser->user_type=="Client")
            return Redirect::to('jobPost/my-jobs');
    }

    /*
     * Read Client New jobs list
     * */
    public function NewJobs()
    {
        //Helpers::debug($this->loginUser->user_id,1);
        $viewModel = array();
        if($this->loginUser->user_type=="Client")
            $jobPostList = JobPost::with('JobCategory')->where('client_id',$this->loginUser->user_id)->whereIn('job_status',array('Pending','Approved'))->orderBy('created_at', 'DESC')->get();
        elseif($this->loginUser->user_type=="Admin")
            $jobPostList = JobPost::with('JobCategory')->whereIn('job_status',array('Pending','Approved'))->orderBy('created_at', 'DESC')->get();
       /* $my_jobs = array();*/
        foreach($jobPostList as $i => $job)
        {
            $jobPostList[$i]->description = Str::words(html_entity_decode(strip_tags($job->description), ENT_QUOTES, 'utf-8'),150);
        }

        $viewModel['my_jobs'] = $jobPostList;
        foreach($jobPostList as $i=>$jobPost){
            $jobPostList[$i]['skills']=$jobPost->GetMyTags();
            $jobPostList[$i]['code'] = Helpers::EncodeDecode($jobPost->id);

        }
        //Helpers::debug($viewModel,1);
        return Theme::make('job.myjobs',$viewModel);
    }
    /*
     * Read Client progress jobs list
     * */
    public function ProgressJobs()
    {
        //Helpers::debug($this->loginUser->user_id,1);
        $viewModel = array();
        if($this->loginUser->user_type=="Client")
            $jobPostList = JobPost::with('JobCategory')->where(array('client_id'=>$this->loginUser->user_id))->whereIn('job_status',array('Accepted','Progress'))->orderBy('created_at', 'DESC')->get();
        elseif($this->loginUser->user_type=="Admin")
            $jobPostList = JobPost::with('JobCategory')->whereIn('job_status',array('Accepted','Progress'))->orderBy('created_at', 'DESC')->get();

        $viewModel['my_jobs'] = $jobPostList;
        foreach($jobPostList as $i=>$jobPost){
            $jobPostList[$i]['skills']=$jobPost->GetMyTags();
            $jobPostList[$i]['code'] = Helpers::EncodeDecode($jobPost->id);

        }
        //Helpers::debug($viewModel,1);
        return Theme::make('job.myjobs',$viewModel);
    }

    /*
     * Read Client complete jobs list
     * */
    public function CompleteJobs()
    {
        $viewModel = array();
        if($this->loginUser->user_type=="Client")
            $jobPostList = JobPost::with('JobCategory')->where(array('client_id'=>$this->loginUser->user_id,'job_status'=>'Completed'))->orderBy('created_at', 'DESC')->get();
        elseif($this->loginUser->user_type=="Admin")
            $jobPostList = JobPost::with('JobCategory')->where('job_status','Completed')->orderBy('created_at', 'DESC')->get();

        $viewModel['my_jobs'] = $jobPostList;
        foreach($jobPostList as $i=>$jobPost){
            $jobPostList[$i]['skills']=$jobPost->GetMyTags();
            $jobPostList[$i]['code'] = Helpers::EncodeDecode($jobPost->id);

        }
        return Theme::make('job.myjobs',$viewModel);
    }

    /*
     * Read Client Request jobs list
     * */
    public function RequestJobs()
    {
        $viewModel = array();
        if($this->loginUser->user_type=="Client")
            $jobPostList = JobPost::with('Client','JobCategory','JobRequest')->where(array('client_id'=>$this->loginUser->user_id))->orderBy('created_at', 'DESC')->get();
        elseif($this->loginUser->user_type=="Admin")
            $jobPostList = JobPost::with('Client','JobCategory','JobRequest')->orderBy('created_at', 'DESC')->get();

        $viewModel['my_jobs'] = $jobPostList;
        return Theme::make('job.request-jobs',$viewModel);
    }

    /*
     * Read Client all jobs list
     * */
    public function AllJobs()
    {
        $viewModel = array();
        $jobPostList = JobPost::with('JobCategory')->orderBy('created_at', 'DESC')->get();
        $viewModel['my_jobs'] = $jobPostList;
        foreach($jobPostList as $i=>$jobPost){
            $jobPostList[$i]['skills']=$jobPost->GetMyTags();
            $jobPostList[$i]['code'] = Helpers::EncodeDecode($jobPost->id);
        }
        return Theme::make('job.all-jobs',$viewModel);
    }
    /*
     * Create job by Client
     * */
    public function CreateJob()
    {
        $viewModel = array('error_msg'=>array());

        $flag = Theme::getSessionData('job_create_flag');
        if( array_search('home',$flag)===false)
            return Redirect::to('/');
        elseif(array_search('price',$flag)===false)
            return Redirect::to('/home/price');
        elseif(array_search('search',$flag)===false)
            return Redirect::to('/search/freelancer');

//        if($this->loginUser->user_type=="Client")
//            Session::put('job_create_flag',array());

        $viewModel['job_categories'] = JobCategory::all();
        $viewModel['skills'] = SkillTag::all();
        $viewModel['clients'] = Client::where('client_status','Active')->get();
        $viewModel['job_prices'] = JobPriceCategory::all();
        $viewModel['page'] = 'create-job';
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $valid_msg =  JobPostValidator::validate($post_data);
            //Helpers::debug($post_data);
            //die();
            if(is_array($valid_msg) && empty($valid_msg)){

            }else{
                $viewModel['error_msg'] = $valid_msg;
            }
        }
        return Theme::make('job.createjob',$viewModel);
    }

    public function NewJobCreate()
    {
        $viewModel = array('error_msg'=>array());

        $viewModel['job_categories'] = JobCategory::all();
        $viewModel['skills'] = SkillTag::all();
        $viewModel['clients'] = Client::where('client_status','Active')->get();
        $viewModel['job_prices'] = JobPriceCategory::all();
        $viewModel['page'] = 'create-job';
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $valid_msg =  JobPostValidator::validate($post_data);
            //Helpers::debug($post_data);
            //die();
            if(is_array($valid_msg) && empty($valid_msg)){

            }else{
                $viewModel['error_msg'] = $valid_msg;
            }
        }
        return Theme::make('job.new-job',$viewModel);
    }

    public function Add(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();			
			
            $errorMsg =  array();
            if($this->loginUser->user_type=="Client"){
                $errorMsg =  JobPostValidator::validate($post_data);
            }elseif($this->loginUser->user_type=="Admin"){
                $errorMsg =  JobPostValidator::validateAdmin($post_data);
            }
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
            $post_data['job_price_range']=implode(',',$post_data['freelancer_price']);
            $hourPerF =0;
            if(count($post_data['selectFlInfo'])>0)
                $hourPerF = round($post_data['hour']/count($post_data['selectFlInfo']));
//            Helpers::debug($hourPerF);
//            Helpers::debug($post_data,1);

            if($this->loginUser->user_type=="Client"){
                $post_data['client_id'] = $this->loginUser->getattribute('user_id');
                $post_data['job_status'] = 'Pending';
            }elseif($this->loginUser->user_type=="Admin"){
                $post_data['job_status'] = 'Approved';
            }

            $jobPost = JobPost::Persist($post_data);
            if(!empty($jobPost) && !empty($jobPost->id)){
				$jobPost->AssignTag($jobPost,$post_data['skill_tags_id']);
                $total_price = 0;
				foreach($post_data['selectFlInfo'] as $fData){
                    $data['freelancer_id'] =  $fData['fid'];
                    $data['client_id'] =  $post_data['client_id'];
                    $data['job_post_id'] =  $jobPost->id;
                    $data['title'] =  $post_data['title'];
                    $data['description'] =  $post_data['description'];
                    if($this->loginUser->user_type=="Client"){
                        $data['job_offer_status'] =  'Pending';
                        $data['job_offer_status_reason'] =  "New job has been created";
                    }elseif($this->loginUser->user_type=="Admin"){
                        $data['job_offer_status'] =  'Approved';
                        $data['job_offer_status_reason'] =  "New job has been created and approved by admin";
                    }

                    $data['job_offer_price'] =  $hourPerF*$fData['freelancer_price'];
                    $data['job_offer_hour'] =  $hourPerF;
                    $jobOffer=JobOffer::Persist($data);
                    $total_price += $data['job_offer_price'];

                }
                $jobPost = JobPost::Persist(array('id'=>$jobPost->id,'amount'=>$total_price));

//				$this->addJobRequest($this->loginUser->getattribute('user_id'),$jobPost->id,$post_data);
                return array(
                    'status'=>'200',
                    'url'=> url('jobPost/view/'.Helpers::EncodeDecode($jobPost->id)),
                    'msg'=>array(array('Job Post has been submitted successfully.')),
                    'newData' => $jobPost
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Post has not been saved.')));
            }


        }else{
            return Redirect::to('/');
        }
    }

    /*
     * Update ajax request job post by Client
     * */
    public function UpdateJob(){
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
			
            $errorMsg =  JobPostValidator::validateUpdate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
			$post_data['id']=Helpers::EncodeDecode($post_data['id'],false);
            if($this->loginUser->user_type=="Client")
                $post_data['client_id'] = $this->loginUser->getattribute('user_id');

            $jobPost = JobPost::Persist($post_data);
            if(!empty($jobPost) && !empty($jobPost->id))
            {
				//$jobPost->DeleteMyTags();
				//$jobPost->AssignTag($jobPost,$post_data['skill_tag']);
				//$jobPost = JobPost::find($jobPost->id);
                return array(
                    'status'=>'200',
                    //'url'=> url('jobPost/create-job'),
                    'msg'=>array(array('Job Post has been submitted successfully.')),
                    'newData' => $jobPost,
					//'select_skills' => $jobPost->GetMyTagsForSelect2()
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Post has not been saved.')));
            }


        }else{
            return Redirect::to('/');
        }
    }
	
	public function DeleteJob(){
		if(Request::isMethod('post'))
        {
            $post_data = Input::all();
			$jobPost = JobPost::find($post_data['id']);			
            
            if(count($jobPost)){	
				if(!empty($jobPost->attach_file)){
					$fileNames = json_decode($jobPost->attach_file,true);
					foreach($fileNames as $fileName){			
						if (!File::delete(Theme::getUploadAbsolutePath('JobPost'). '/'.$fileName)) 
							return array('status'=>'400','msg'=>array(array('Unable to delete file!. Please try again')));
					}
				}
				$jobPost->delete();
				
                return array(
                    'status'=>'200',
                    'url'=> url('jobPost/my-jobs'),
                    'msg'=>array(array('Job Post has been deleted successfully.'))
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Post has not been deleted.')));
            }
        }else{
            return Redirect::to('/');
        }
	}
	
    public function FileDownload($name){

        $file= Theme::getUploadAbsolutePath('JobPost'). '/' . $name;

        $fileInfo = new Symfony\Component\HttpFoundation\File\File($file);
        $mime = $fileInfo->getMimeType();
        $headers = array(
            'Content-Type: '.$mime,
        );
        return Response::download($file, $name, $headers);
    }
	
	public function UploadFile(){
		if(Request::isMethod('post'))
        {
            $post_data = Input::all();		
                
            //$errorMsg =  JobPostValidator::validateOnlyFile($post_data));
			//Helpers::debug($post_data['file']->getMimeTypes(),1);
//			Helpers::debug($errorMsg,1);
            /*if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }*/
			$fileName = array();
			
            if (Input::hasFile('file'))
            { 

				$allFile = Input::file('file');
                
                if(!in_array($allFile->getClientOriginalExtension(),array('png','gif','jpeg','txt','pdf','doc','docx','ppt','pptx','rtf','zip','xlsx','xls')))
                {
                  return array('status'=>'400','msg'=>array(array('Unable to upload file!'))); 
                }

                $filename = strstr($allFile->getClientOriginalName(), '.', true);
                $uniqueFilename = uniqid($filename . '_');
				
				$path = Theme::getUploadAbsolutePath('JobPost');
                if(!File::exists($path))
                {
                    File::makeDirectory($path,777);
                }

                $flag = $allFile->move($path, $uniqueFilename.'.'. $allFile->getClientOriginalExtension());
				if(!empty($flag)){
                    $fileName[] = $flag->getfilename();
                }
            }
			//Helpers::debug($fileName);
			//die();
            $post_data['id'] = Helpers::EncodeDecode($post_data['id'],false);
            $fileNames = JobPost::UpdateAttachFile($post_data,$fileName);
            if(!empty($fileNames))
            {
                return array(
                    'status'=>'200',
                    'url'=> url('jobPost/create-job'),
                    'msg'=>array(array('File ('.Input::file('file')->getClientOriginalName().') has been uploaded successfully.')),
                    'newData' => $fileNames
                );
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry File ('.Input::file('file')->getClientOriginalName().') has not been uploaded successfully.')));
            }


        }else{
            return Redirect::to('/');
        }
	}
	
	public function DeleteFile(){
		if(Request::isMethod('post'))
        {
            $post_data = Input::all();
			
			if (!File::delete(Theme::getUploadAbsolutePath('JobPost'). '/'.$post_data['file_name'])) {
				return array('status'=>'400','msg'=>array(array('Unable to delete file!')));
			}
            $fileNames = JobPost::DeleteFile($post_data);
            return array(
                'status'=>'200',
                'url'=> url('jobPost/edit/'.$post_data['id']),
                'msg'=>array(array('This file has been deleted successfully.')),
                'newData' => $fileNames
            );


        }else{
            return Redirect::to('/');
        }
	}
	/*
     * Edit job by Client
     * */
    public function View($id)
    {
        $viewModel = array();
		$dId=Helpers::EncodeDecode($id,false);
		//Helpers::debug($dId);die();
        if($this->loginUser->user_type=="Client"){
            $jobPost = JobPost::with("Client","JobCategory",'JobOffer','JobOffer.Freelancer','JobOffer.JobPhase','JobOffer.Comments','JobOffer.Comments.honour')->where(array('id'=>$dId,'client_id'=>$this->loginUser->user_id))->get();
            $jobPost = $jobPost[0];
        }else{
            $jobPost = JobPost::with("Client","JobCategory",'JobOffer','JobOffer.Freelancer','JobOffer.JobPhase','JobOffer.Comments','JobOffer.Comments.honour')->find($dId);
        }
        $requestedFreelancerList = JobRequest::with('Freelancer')->where('job_id',$dId)->get();
        foreach($requestedFreelancerList as $i=>$freelancer){
            $requestedFreelancerList[$i]['freelancer']['skills']=RelatedTag::with('GetTag')->where(array('relatedentity_id'=>$freelancer->freelancer_id,'relatedentity_type'=>'Freelancer'))->get();
            $requestedFreelancerList[$i]['freelancer']['portfolio_item'] = Portfolio::where(array('freelancer_id'=>$freelancer->freelancer_id))->count();
        }
        $priceRange = explode(',',$jobPost->job_price_range);
        $jobPost->price_range = $priceRange;
        $viewModel['clients'] = Client::where('client_status','Active')->get();

        $viewModel['job_prices'] = JobPriceCategory::all();
        $viewModel['skills'] = SkillTag::all();
		$jobPost['code'] = $id;
        
        $viewModel['job_post'] = $jobPost;
        $viewModel['job_post']['attach_file']=json_decode($jobPost->attach_file);
        $viewModel['requested_freelancer'] = $requestedFreelancerList;
        $viewModel['select_skills'] = $jobPost->GetMyTags();
//        $viewModel['select_skills'] = $jobPost->GetMyTags();
        $viewModel['destination_path']=Theme::getDownloadRelativePath('JobPost');
		$viewModel['client_code'] = Helpers::EncodeDecode($jobPost->client_id);
		$viewModel['total_job'] = JobPost::where('client_id', '=', $jobPost->client_id)->count();
		$viewModel['job_total_amount'] = JobPost::TotalAmountJobPost($jobPost->id);
		$viewModel['job_total_hour'] = JobPost::TotalHourJobPost($jobPost->id);
        $viewModel['total_amount'] = Client::TotalAmountAllJob($jobPost->client_id);
        $viewModel['total_progress_job'] = Client::ProgressJob($jobPost->client_id);
        $viewModel['total_completed_job'] = Client::CompleteJob($jobPost->client_id);

        return Theme::make('job.viewjob',$viewModel);
    }
	
	public function addJobRequest($client_id,$job_id,$post_data){
		$new_post_data['job_id']=$job_id;
		
		foreach($post_data['selectFlInfo'] as $pd){
			$new_post_data['freelancer_id']=$pd['fid'];
			$new_post_data['request_status']='Pending';
			$jobRequest = JobRequest::Persist($new_post_data);
			//var_dump($post_data['selectFlInfo'][0]['id']);
			//die();
		}
	}
	
	public function UpdateJobStatus()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $jobPost = JobPost::find(Helpers::EncodeDecode($post_data['code'],false));
            if(count($jobPost))
            {
                $jobPost->job_status = $post_data['type'];
                $jobPost->save();
                return array('status'=>'200','url'=> '','newData'=>$jobPost);
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! This job has not been accepted.')));
			}

        }
        else{
            return Redirect::to('/');
        }
    }
} 