<?php
/**
 * Created by PhpStorm.
 * User: HimelC51
 * Date: 10/14/14
 * Time: 10:52 AM
 */

class ApplyJobController extends BaseController{

    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = Helpers::AdminToGeneralProfileAccess();

        /* View::share('authenticateUserInfo',$this->user);*/
        if(count($this->user))
        {
            if($this->user->user_type  == 'Freelancer')
            {
                $freelancer = Freelancer::find($this->user->user_id);
                View::share('notifications',(count($freelancer))? $freelancer->Notifications : array());
            }
            elseif($this->user->user_type  == 'Client')
            {
                $client = Client::find($this->user->user_id);
                View::share('notifications',(count($client))? $client->Notifications : array());
            }elseif($this->user->user_type  == 'Admin'){
                $admin = Admin::find($this->user->user_id);
                View::share('notifications',(count($admin))? $admin->Notifications : array());
            }
        }
    }

    public function index()
    {
        if(Request::isMethod('post'))
        {


            if(count($this->user))
            {
                $rurl = Session::get('rurl');
                if (!empty($rurl)) {
                    Session::forget('rurl');
                }
                $postData = Input::all();

                $jobRequest = JobRequest::Persist(array(
                   'freelancer_id'   => $postData['fid'],
                   'job_id'          => $postData['jid'],
                    'request_status' => 'Requested'
                ));
                Helpers::addMessage(200, ' Your job request submitted successfully');
                return Redirect::to('view/job/'.Helpers::EncodeDecode($postData['jcid']).'/'.Helpers::EncodeDecode($postData['jid']));
            }
            else
            {

                Session::put('rurl',Input::get('rurl'));
                return Redirect::to('home/login');
            }
        }else{
            return Redirect::to('home/login');
        }
    }
} 