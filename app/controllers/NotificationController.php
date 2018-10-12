<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/22/14
 * Time: 1:55 PM
 */

class NotificationController extends BaseController{
    protected $loginUser;
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

    public function index()
    {
        return Redirect::to('/');
    }

    public function view()
    {
        $viewModel = array();
        $id = Request::segment(3);
        $nid = Helpers::EncodeDecode($id,false);
        $notification = Notification::find($nid);
        if($notification->notification_type=='Job Post'){
            $job = JobPost::find(Helpers::EncodeDecode($notification->object_id,false));
        }else{
            $job = JobOffer::find(Helpers::EncodeDecode($notification->object_id,false));
        }

        if(count($notification))
        {
            $client = Client::find($this->user_id);
            $notification->read_status = 1;
            $notification->save();
            View::share('notifications',(count($client))? $client->UnreadNotifications : array());
            $viewModel = array(
                'user'=>$this->loginUser,
                'notification'=>$notification,
                'client'=>$client,
                'job'=>$job
            );

            return Theme::make('notification.job',$viewModel);
        }else{
            return Redirect::to('/');
        }
    }
} 