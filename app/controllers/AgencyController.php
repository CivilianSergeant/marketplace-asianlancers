<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/21/14
 * Time: 2:52 PM
 */

class AgencyController extends BaseController{

    protected $defaultRoute = 'agency/members';
    protected $userAccount;
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $loggedUser = Helpers::AdminToGeneralProfileAccess();//Sentry::getUser();

        $this->userAccount = $loggedUser;

        $this->user_id = $this->userAccount->user_id;

        View::share('authenticateUserInfo',$loggedUser);
        $freelancer = Freelancer::find($this->user_id);

        View::share('notifications',(count($freelancer))? $freelancer->Notifications : array());
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
    }

    public function index()
    {
        return Redirect::to($this->defaultRoute);
    }

    public function searchMember()
    {
        $viewModel = array();
        $viewModel['skills'] = SkillTag::all();
        $freelancer = Freelancer::find($this->user_id);
        $viewModel['members'] = ($freelancer->freelancer_type == 'Agency') ? $freelancer->GetAgencyMembers : array();
        return Theme::make('freelancer.agency.search-members',$viewModel);
    }

    public function members()
    {
        $freelancer = Freelancer::find($this->user_id);
        if(!empty($freelancer->id))
        {
            $members = $freelancer->GetAgencyMembers;
            $viewModel['members'] = $members;
            $viewModel['freelancer'] = $freelancer;
            return Theme::make('freelancer.agency.members',$viewModel);
        }else{
            Helpers::addMessage(400, ' No profile found for freelancer');
            return Redirect::to('freelancer/overview');
        }
    }

    public function addMember()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::get('freelancer_id');
            foreach($post_data as  $data)
            {
                $postData = array('freelancer_id'=>$data['fid'],'agency_id'=>$this->user_id);
                $agencyMember = AgencyMember::Persist($postData);
            }

            if(!empty($agencyMember) && !empty($agencyMember['obj']->id))
            {
                return array('status'=>$agencyMember['status'],'url'=> url($this->defaultRoute), 'result'=>$agencyMember['obj']);
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry education information not saved')));
            }
        }
    }

} 