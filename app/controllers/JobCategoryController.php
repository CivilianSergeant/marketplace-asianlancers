<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/21/14
 * Time: 10:51 AM
 */

class JobCategoryController extends BaseController{

    protected $loginUser;
    protected $user_id;

    public function __construct()
    {
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

    public function Index()
    {
        $viewModel = array();
        $viewModel['job_categories'] = JobCategory::all();
        return Theme::make('job.jobcategory',$viewModel);
    }

    public function Add()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  JobCategoryValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }			
            $jobCategory = JobCategory::Persist($post_data);
            if(!empty($jobCategory) && !empty($jobCategory->id))
            {
                return array(
						'status'=>'200',
						'url'=> url('jobCategory'),
						'msg'=>array(array('Job Category has been submited successfully.')),
						'newData' => $jobCategory
					);
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Category has not been saved.')));
            }


        }else{
            return Redirect::to('/');
        }
    }

    public function UpdateDisplay()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $jobCategory = JobCategory::find($post_data['id']);
            if(count($jobCategory))
            {
                $jobCategory->display = $post_data['value'];
                $jobCategory->save();
                return array('status'=>'200','url'=> url('jobCategory'),'msg'=>array(array('Display value of Job Category has been updated successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Display value of Job Category has not been updated.')));
			}

        }
        else{
            return Redirect::to('/');
        }
    }

    public function Delete()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $jobCategory = JobCategory::find($post_data['id']);
            if(count($jobCategory))
            {
                $jobCategory->delete();
                return array('status'=>'200','url'=> url('jobCategory'),'msg'=>array(array('Job Category has been deleted successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Job Category has not been deleted.')));
			}
        }else{
            return Redirect::to('/');
        }
    }

    public function PermanentDelete()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $jobCategory = JobCategory::find($post_data['id']);
            if(count($jobCategory))
            {
                $jobCategory->forceDelete();
                return array('status'=>'200','url'=> url('jobCategory'),'msg'=>array(array('Job Category has been deleted permanently.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Job Category has not been deleted.')));
			}
        }else{
            return Redirect::to('/');
        }
    }


} 