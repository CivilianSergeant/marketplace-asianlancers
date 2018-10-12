<?php
/**
 * Created by PhpStorm.
 * User: sanzeeb
 * Date: 9/8/14
 * Time: 1:33 PM
 */

class SettingController extends BaseController {

    protected $user;
    protected $user_id;
   // protected $profileUserId;
    public function __construct()
    {
        parent::__construct();

        $this->user = Helpers::AdminToGeneralProfileAccess();
        $this->user_id = $this->user->user_id;
       /* View::share('authenticateUserInfo',$this->user);*/
        if($this->user->user_type  == 'Freelancer')
        {
            $freelancer = Freelancer::find($this->user->user_id);
            View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
            View::share('notifications',(count($freelancer))? $freelancer->UnreadNotifications : array());
        }
        elseif($this->user->user_type  == 'Client')
        {
            $client = Client::find($this->user->user_id);
            View::share('notifications',(count($client))? $client->UnreadNotifications : array());

        }elseif($this->user->user_type  == 'Admin'){

            $admin = Admin::find($this->user->user_id);
            View::share('notifications',(count($admin))? $admin->UnreadNotifications : array());

        }
    }

    public function Index()
    {

    }

    public function loginAdmin()
    {
        Helpers::AdminToGeneralProfileAccess();
        return Redirect::to('admin');
    }

    public function ChangePassword()
    {
        $viewModel = array();

        if(Request::isMethod('post'))
        {

           $data = Input::all();

            $response = array();

            if(($data['oldPassword']=='') || ($data['newPassword']=='')||($data['confPassword']=='') )
            {
                $response['status'] = 'Error' ;
                $response['message'] = 'Please provide all password !';

                return $response;
            }

           if($data['newPassword'] != $data['confPassword'] )
           {
               $response['status'] = 'Error' ;
               $response['message'] = 'New provided passwords are mismatched !';

               return $response;
           }
           if($this->user->checkPassword($data['oldPassword']))
           {
               $this->user->password = $data['newPassword'];
               $this->user->save();
               $response['status'] = 'Success' ;
               $response['message'] = 'Password Changed Successfully.';

               return $response;
           }else{

               $response['status'] = 'Error' ;
               $response['message'] = 'Old password mismatched!';

               return $response;
           }
        }else{
            return Theme::make('setting.change-password',$viewModel);
        }
    }

    public function freelancer()
    {
        if($this->user->user_type == 'client')
            return Redirect::to('setting/client');
        $viewModel = array();
        $freelancer = Freelancer::find($this->user->user_id);
        $viewModel['freelancer'] = $freelancer;
        return Theme::make('setting.freelancer',$viewModel);
    }

    public function client()
    {
        if($this->user->user_type == 'freelancer')
            return Redirect::to('setting/freelancer');
        $client = Client::find($this->user->user_id);
        $viewModel['client'] = $client;
        return Theme::make('setting.client',$viewModel);
    }




} 