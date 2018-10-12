<?php

/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/22/14
 * Time: 1:55 PM
 */
class ViewController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        View::share('notifications', array());
        View::share('notifications_count', 0);
        View::share('messageCount',0);
    }

    public function index()
    {
        return Redirect::to('/');
    }

    public function freelancer()
    {
        $viewModel = array();
        $id = Request::segment(3);
        $id = Helpers::EncodeDecode($id, false);
        $freelancer = Freelancer::with('RelatedTags', 'Certifications', 'ProfessionalBackgrounds', 'Educations', 'Portfolios')->where('id', $id)->first();
        if (count($freelancer)) {

            $user = User::where('user_id', $freelancer->id)->first();

            if (count($freelancer))
                $freelancer->completed_percentage = $freelancer->GetProfileCompleteStatus($freelancer, $user);
            $viewModel['freelancer'] = $freelancer;
            $viewModel['members'] = (count($freelancer) > 0) ? $freelancer->GetAgencyMembers : json_encode(array());
            $viewModel['agencies'] = (count($freelancer) > 0) ? $freelancer->GetAgencies() : json_encode(array());

            $viewModel['educations'] = (count($freelancer) > 0) ? $freelancer->Educations : json_encode(array());
            $viewModel['portfolios'] = (count($freelancer) > 0) ? $freelancer->Portfolios : json_encode(array());
          //  Helpers::debug($viewModel['portfolios']);die();
            $viewModel['rskills'] = (count($freelancer) > 0) ? $freelancer->GetMyTags() : json_encode(array());
            $viewModel['test_taken'] = (count($freelancer) > 0) ? $freelancer->numOfExamTaken() : json_encode(array());
            $viewModel['certs'] = (count($freelancer) > 0) ? $freelancer->Certifications : json_encode(array());
            $viewModel['prices'] = JobPriceCategory::all();
            $viewModel['user'] = $user;
            $viewModel['filePath'] = 'cdn/profile/freelancer/portfolio/' . $freelancer->email . '/';
            $viewModel['imgUrl'] = CDN . 'profile/freelancer/portfolio/' . $freelancer->email . '/';
            $viewModel['pbs'] = (count($freelancer) > 0) ? $freelancer->ProfessionalBackgrounds : json_encode(array());
        } else {
            return Redirect::to('/');
        }
        return Theme::make('view.freelancer', $viewModel);
    }

    public function client()
    {
        $client_id = Request::segment(3);
        $client_id = Helpers::EncodeDecode($client_id, false);
        $client = Client::find($client_id);

        //Helpers::debug($client,1);

        $viewModel = array();
        $viewModel['client_info'] = $client;
        $viewModel['total_job'] = JobPost::where('client_id', '=', $client_id)->count();
        $viewModel['total_amount'] = Client::TotalAmountAllJob($client_id);
        $viewModel['total_progress_job'] = Client::ProgressJob($client_id);
        $viewModel['total_completed_job'] = Client::CompleteJob($client_id);
        $viewModel['destination_path'] = Theme::getDownloadRelativePath('ClientProfilePicture');


        return Theme::make('view.client', $viewModel);
    }

    public function job()
    {
        $viewModel = array();
        $category_id = Request::segment(3);
        $job_id = Request::segment(4);
        $loggedUser = Helpers::AdminToGeneralProfileAccess();

        $category_id = Helpers::EncodeDecode($category_id, false);
        $job_id = Helpers::EncodeDecode($job_id, false);
        $jobObj = new Job();


        if ((!empty($job_id) && !empty($category_id)) && (is_numeric($job_id) && is_numeric($category_id))) {
            $jobPost = JobPost::with("Client", "JobCategory", 'JobOffer', 'JobOffer.Freelancer', 'JobOffer.JobPhase', 'JobOffer.Comments', 'JobOffer.Comments.honour')
                ->where(array('id' => $job_id))->first();
            $my_offer_exists = array();

            if (count($loggedUser) && $loggedUser->user_type == 'Freelancer') {
                $viewModel['jobInvitation'] = JobOffer::where('freelancer_id', $loggedUser->user_id)->where('job_post_id', $job_id)->first();

                $viewModel['jobrequest'] = JobRequest::where('freelancer_id', $loggedUser->user_id)->where('job_id', $job_id)->first();

                $my_offer_exists = JobOffer::where(array('freelancer_id' => $loggedUser->user_id, 'job_post_id' => $job_id))
                    ->whereIn('job_offer_status', array('Approved', 'Accepted', 'Progress', 'Paused'))
                    ->orderBy('created_at', 'DESC')->get();
            }

            $viewModel['my_offer_exists'] = $my_offer_exists;
            $job = $jobObj->search($job_id, $category_id);
            $client = Client::find($job->client_id);


            $viewModel['client'] = $client;
            $viewModel['job'] = $job;
            $viewModel['user'] = $loggedUser;

            $viewModel['job_post'] = $jobPost;
            $viewModel['job_prices'] = JobPriceCategory::all();
            $viewModel['skills'] = SkillTag::all();
            $viewModel['select_skills'] = $jobPost->GetMyTags();
            $viewModel['destination_path'] = Theme::getDownloadRelativePath('JobPost');
            $viewModel['job_post']['attach_file'] = json_decode($jobPost->attach_file);

            $viewModel['total_job'] = JobPost::where('client_id', '=', $job->client_id)->count();
            $viewModel['job_total_amount'] = JobPost::TotalAmountJobPost($job_id);
            $viewModel['job_total_hour'] = JobPost::TotalHourJobPost($job_id);
            $viewModel['total_amount'] = Client::TotalAmountAllJob($job->client_id);
            $viewModel['total_progress_job'] = Client::ProgressJob($job->client_id);
            $viewModel['total_completed_job'] = Client::CompleteJob($job->client_id);

        } else {
            Helpers::addMessage(400, " No job found.");
            return Redirect::to('home/login');
        }
        if(count($loggedUser) && $loggedUser->user_type=='Freelancer')
        {

            $freelancer = Freelancer::find($loggedUser->user_id);
            View::share('messageCount',DiscussionComments::UnreadMessageCount($loggedUser->user_id));
            View::share('notifications',(count($freelancer))? $freelancer->UnreadNotifications : array());

        }

        return Theme::make('view.job-details', $viewModel);
    }

    public function page($url)
    {
        $page = Page::where('url',$url)->first();
        $viewModel = array(
            'page' => $page
        );
        //Helpers::debug($page,1);
        return Theme::make('front.page',$viewModel);
    }


}