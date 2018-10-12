<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/21/14
 * Time: 10:51 AM
 */

class JobPriceCategoryController extends BaseController{

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
        $viewModel['job_price_categories'] = JobPriceCategory::all();
        return Theme::make('job.pricecategory',$viewModel);
    }

    public function Add()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  JobPriceCategoryValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }			
            $jobPriceCategory = JobPriceCategory::Persist($post_data);
            if(!empty($jobPriceCategory) && !empty($jobPriceCategory->id))
            {
                return array(
						'status'=>'200',
						'url'=> url('jobPriceCategory'),
						'msg'=>array(array('Job Price Category has been submited successfully.')),
						'newData' => $jobPriceCategory
					);
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Job Price Category has not been saved.')));
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
            $jobPriceCategory = JobPriceCategory::find($post_data['id']);
            if(count($jobPriceCategory))
            {
                $jobPriceCategory->display = $post_data['value'];
                $jobPriceCategory->save();
                return array('status'=>'200','url'=> url('jobPriceCategory'),'msg'=>array(array('Display value of Job Price Category has been updated successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Display value of Job Price Category has not been updated.')));
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
            $jobPriceCategory = JobPriceCategory::find($post_data['id']);
            if(count($jobPriceCategory))
            {
                $jobPriceCategory->delete();
                return array('status'=>'200','url'=> url('jobPriceCategory'),'msg'=>array(array('Job Price Category has been deleted successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Job Price Category has not been deleted.')));
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
            $jobPriceCategory = jobPriceCategory::find($post_data['id']);
            if(count($jobPriceCategory))
            {
                $jobPriceCategory->forceDelete();
                return array('status'=>'200','url'=> url('jobPriceCategory'),'msg'=>array(array('Job Price Category has been deleted permanently.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Job Price Category has not been deleted.')));
			}
        }else{
            return Redirect::to('/');
        }
    }


} 