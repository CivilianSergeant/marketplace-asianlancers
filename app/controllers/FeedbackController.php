<?php
/**
 * Created by PhpStorm.
 * User: HimelC51
 * Date: 10/13/14
 * Time: 2:44 PM
 */

class FeedbackController extends BaseController{

    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = Helpers::AdminToGeneralProfileAccess();

        /* View::share('authenticateUserInfo',$this->user);*/
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user->user_id));
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

    public function index()
    {
        $viewModel = array();
        return Theme::make('feedback.index',$viewModel);
    }
} 