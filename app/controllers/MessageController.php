<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 7/8/14
 * Time: 3:39 PM
 */

class MessageController extends BaseController{

    protected $defaultRoute = 'message/index';
    protected $userAccount;
    protected $user_id;

    protected $pageLimit;

    public function __construct()
    {
        parent::__construct();
        $loggedUser = Helpers::AdminToGeneralProfileAccess();//Sentry::getUser();

        $this->userAccount = $loggedUser;

        $this->user_id = $this->userAccount->user_id;

        View::share('authenticateUserInfo',$loggedUser);
        $freelancer = Freelancer::find($this->user_id);
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
        View::share('notifications',(count($freelancer))? $freelancer->UnreadNotifications : array());
   
    }

    
    public function index()
    {
        return Redirect::to("message/lists");
    }

    public function lists()
    {
        $sessionUId = $this->user_id;

        $viewModel = array(
            'theme'=> Theme::getTheme(),
            'user' => $this->userAccount,
            'commentall' => DiscussionComments::where('receiver_id',$sessionUId)->where('type','Notification')->OrderBy('id','DESC')->get()
        );
        return Theme::make('messagebox.index',$viewModel);
    }

    public function sentItems()
    {
        $sessionUId = $this->user_id;
       
        $viewModel = array(
            'theme'=> Theme::getTheme(),
            'user' => $this->userAccount,
            'sentitems' => Discussion::where('sender_id',$sessionUId)->OrderBy('id','DESC')->get()
        );
        return Theme::make('messagebox.sent-items',$viewModel);
    }

    public function compose()
    {
        $receivers=  array();
        if($this->userAccount->user_type=="Admin"){
            $receivers =  User::all();
        }else{
            $receivers=User::where("user_type","Admin")->get();
        }

        $viewModel = array(
            'theme' =>  Theme::getTheme(),
            'user'  => $this->userAccount,
            'receivers' => $receivers
        );

        return Theme::make('messagebox.compose',$viewModel);
    }

    public function saveMessage()
    {
      $response = MessageSystem::saveDiscussion($this->userAccount);
      Helpers::addMessage($response['status'],$response['msg']);

      return Redirect::to($this->defaultRoute);
    }


    public function details()
    {
        $id = Request::segment(3);
        $cid = Request::segment(4);
        $discussion = Discussion::find($id);


        $viewModel = array(
          'theme' => Theme::getTheme(),
          'user'  => $this->userAccount
        );

        if(count($discussion))
        {

            $comment = DiscussionComments::find($cid);

            if(count($comment))
            {
                $comment->read_status =1;
                $comment->save();
            }

            $inbox = DiscussionComments::where('receiver_id',$this->user_id)->where('read_status',0)->where('type','Notification')->get();
            View::share('comments',$inbox);

            $viewModel['message'] = $discussion;
            return Theme::make('messagebox.details',$viewModel);
        }else{
            Helpers::addMessage(500, " Not Message found, either message deleted or link was expired");
            return Redirect::to($this->defaultRoute);
        }
    }

    public function reply()
    {
        $response = MessageSystem::commentToDiscussion();
        Helpers::addMessage($response['status'],$response['msg']);

        return Redirect::to($response['refurl']);
    }

    public function bulkDeleteComment()
    {
        if(Request::ajax())
        {
            $message_id = Input::get('message_id');
            if(count($message_id))
            {
                foreach($message_id as $mid)
                {
                   $notification = Comment::find($mid);
                   $notification->delete();
                }

            }
        }
        return 1;
    }

    public function bulkDeleteMessage()
    {
        if(Request::ajax())
        {
            $message_id = Input::get('message_id');
            if(count($message_id))
            {
                foreach($message_id as $mid)
                {
                    $message = Discussion::find($mid);
                    $message->delete();
                }

            }
        }
        return 1;
    }

    public function downloadAttachment($fileName)
    {
        $file_url = 'data/attachment/'.urldecode($fileName);
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: Binary');
        header('Content-disposition: attachment; filename="' . basename($file_url) . '"');
        readfile($file_url);
    }
} 