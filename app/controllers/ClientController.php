<?php

/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 1:36 PM
 */
class ClientController extends BaseController
{

    protected $userAccount;
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $loggedUser = Helpers::AdminToGeneralProfileAccess(); //Sentry::getUser();

        $this->userAccount = $loggedUser;

        $this->user_id = $this->userAccount->user_id;

        View::share('authenticateUserInfo', $loggedUser);
        $client = Client::find($this->user_id);
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
        View::share('notifications', (count($client)) ? $client->UnreadNotifications : array());
    }

    public function Index()
    {
        // die();
        $jobPostList = JobPost::with('JobCategory')->where('client_id',$this->userAccount->user_id)->whereIn('job_status',array('Pending','Approved'))->orderBy('created_at', 'DESC')->count();
        $progressjobPostList = JobPost::with('JobCategory')->where('client_id',$this->userAccount->user_id)->whereIn('job_status',array('Progress'))->orderBy('created_at', 'DESC')->count();
        if($progressjobPostList > 0)
            return Redirect::to('jobPost/progress-jobs');
        if($jobPostList > 0)
            return Redirect::to('jobPost/new-jobs');
        else
            return Redirect::to('client/profile');
        
    }

    public function profile()
    {
        $viewModel = array();

        $client = Client::find($this->user_id);
        $viewModel['client_info'] = $client;

        $viewModel['countries'] = Country::all();
        $viewModel['total_job'] = JobPost::where('client_id', '=', $this->user_id)->count();
        $viewModel['total_amount'] = Client::TotalAmountSpent($this->user_id);
        $viewModel['total_progress_job'] = Client::ProgressJob($this->user_id);
        $viewModel['total_completed_job'] = Client::CompleteJob($this->user_id);
        $viewModel['destination_path'] = Theme::getDownloadRelativePath('ClientProfilePicture');

        //Helpers::debug($total,1);
        return Theme::make('client.index', $viewModel);
    }

    public function Update()
    {
        if (Request::isMethod('post')) {
            $post_data = Input::all();

            $errorMsg = ClientValidator::validate($post_data);
            if (count($errorMsg)) {
                return array('status' => '400', 'msg' => $errorMsg);
            }
            //Helpers::debug($post_data);
            //Helpers::debug($errorMsg);
            //die();
            $client = Client::Persist($post_data);
            if (!empty($client) && !empty($client->id)) {
                return array(
                    'status' => '200',
                    'url' => url('jobPost/create-job'),
                    'msg' => array(array('Job Post has been submitted successfully.')),
                    'newData' => $client
                );
            } else {
                return array('status' => '400', 'msg' => array(array('Sorry Job Post has not been saved.')));
            }


        } else {
            return Redirect::to('/');
        }
    }

    public function UploadPicture()
    {
        if (Request::isMethod('post')) {
            $post_data = Input::all();

            //$errorMsg = ClientValidator::validateOnlyFile($post_data);
            $clientInfo = Client::find($post_data['id']);

           /* if (count($errorMsg)) {
                return array('status' => '400', 'msg' => $errorMsg);
            }*/
            $fileName = array();

            if (Input::hasFile('file')) {
                $allFile = Input::file('file');
               
                if(!in_array($allFile->getClientOriginalExtension(),array('png','gif','jpeg','jpg')))
                {
                  return array('status'=>'400','msg'=>array(array('Unable to upload file!'))); 
                }
                $filename = strstr($allFile->getClientOriginalName(), '.', true);
                $uniqueFilename = uniqid($filename . '_');

                $path = Theme::getUploadAbsolutePath('ClientProfilePicture');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 777);
                }

                $flag = $allFile->move($path, $uniqueFilename . '.' . $allFile->getClientOriginalExtension());

                if (!empty($flag)) {
                    $fileName = $flag->getfilename();
                }
            }

            $fileNames = Client::UpdateAttachFile($post_data['id'], $fileName);

            if (count($clientInfo)>0) {
                if($clientInfo->photos){
                    if (!File::delete(Theme::getUploadAbsolutePath('ClientProfilePicture') . '/' . $clientInfo->photos)) {
                        return array('status' => '400', 'msg' => array(array('Unable to delete file!')));
                    }
                }
                return array(
                    'status' => '200',
                    'url' => url('client'),
                    'msg' => array(array('File (' . Input::file('file')->getClientOriginalName() . ') has been uploaded successfully.')),
                    'newData' => $fileNames
                );
            } else {
                return array('status' => '400', 'msg' => array(array('Sorry File (' . Input::file('file')->getClientOriginalName() . ') has not been uploaded successfully.')));
            }


        } else {
            return Redirect::to('/');
        }
    }

    public function jobRequest()
    {
        $id = Request::segment(3);

        $nid = Helpers::EncodeDecode($id, false);

        $notification = Notification::find($nid);

        if (count($notification)) {
            $oid = Helpers::EncodeDecode($notification->object_id, false);
            $jobRequest = JobRequest::find($oid);

            if (count($jobRequest)) {
                $freelancer = Freelancer::find($jobRequest->freelancer_id);
                $viewModel = array(
                    'user' => $this->userAccount,
                    'notification' => $notification,
                    'jobRequest' => $jobRequest,
                    'freelancer' => $freelancer
                );
                if ($freelancer->available == 0) {
                    $notification->read_status = 1;
                    $notification->save();
                }
                return Theme::make('notification.client.job-request', $viewModel);

            } else {

                Helpers::addMessage(400, 'No job request found, may be link was expired.');
                return Redirect::to('client');
            }

        } else {
            Helpers::addMessage(400, ' No job request notification found');
            return Redirect::to('client');
        }
    }

    public function UpdateJobRequest()
    {
        if (Request::isMethod('post')) {
            $post_all = Input::all();
//            Helpers::debug($post_all,1);
            $freelancer = Freelancer::find(Helpers::EncodeDecode($post_all['fid'], false));
            if ($post_all['request_status'] == 'Accepted' && $freelancer->available == 1) {
                if (!empty($post_all['hour'])) {
                    $jobRequest = JobRequest::Persist(array('id' => $post_all['id'], 'request_status' => $post_all['request_status']));
                    Helpers::addMessage(200, ' Job Request ' . $post_all['request_status']);
                    $jobPost = JobPost::find(Helpers::EncodeDecode($post_all['jid'], false));
                    $data['freelancer_id'] = $freelancer->id;
                    $data['client_id'] = $jobPost->client_id;
                    $data['job_post_id'] = $jobPost->id;
                    $data['title'] = $jobPost->title;
                    $data['description'] = $jobPost->description;
                    $data['job_offer_status'] = 'Accepted';
                    $data['job_offer_status_reason'] = "Your request has been accepted by client";
                    $data['job_offer_price'] = $post_all['hour'] * $freelancer->freelancer_price;
                    $data['job_offer_hour'] = $post_all['hour'];
                    $jobOffer = JobOffer::Persist($data);
//                    Helpers::debug($jobOffer,1);

                    $job_price_range = explode(',', $jobPost->job_price_range);
                    if (array_search($freelancer->freelancer_price, $job_price_range) === false)
                        $jobPost->job_price_range = $jobPost->job_price_range . ',' . $freelancer->freelancer_price;
                    $jobPost->amount = $jobPost->amount + $jobOffer->job_offer_price;
                    $jobPost->hour = $jobPost->hour + $jobOffer->job_offer_hour;

                    $jobPost = JobPost::Persist(array(
                        'id' => $jobPost->id,
                        'amount' => $jobPost->amount,
                        'hour' => $jobPost->hour,
                        'job_price_range' => $jobPost->job_price_range,
                    ));

                    if (count($jobPost) && $jobPost->job_status == 'Approved') {
                        $jobPost->job_status = "Progress";
                        $jobPost->save();
                    }
                } else {
                    Helpers::addMessage(400, 'Please give job offer hour');
                    return Redirect::to('client/job-request/' . $post_all['url']);
                }
            } else {
                if ($post_all['request_status'] == 'Declined')
                    Helpers::addMessage(400, ' Job Request ' . $post_all['request_status']);
                elseif ($freelancer->available == 0) {
                    Helpers::addMessage(400, 'This freelancer no longer available.');
                }
                $jobRequest = JobRequest::Persist(array('id' => $post_all['id'], 'request_status' => 'Declined'));
            }
            $notification = Notification::find($post_all['nid']);
            if (count($notification)) {
                $notification->read_status = 1;
                $notification->save();
            }
            return Redirect::to('client/job-request/' . $post_all['url']);

        } else {
            return Redirect::to('client');
        }
    }

    public function feedback()
    {
        if (Request::isMethod('post')) {
            $postData = Input::all();

            $freelancer = Freelancer::find($postData['freelancer_id']);
            $jobOffer = JobOffer::find($postData['offer_id']);
            $viewModel = array();
            $viewModel['jobOffer'] = $jobOffer;
            $viewModel['freelancer'] = $freelancer;
            $viewModel['feedback'] = Feedback::where('feedbacks_id', $freelancer->id)->where('feedbacks_type', 'Freelancer')->where('job_offer_id', $jobOffer->id)->first();
            return Theme::make('feedback.index', $viewModel);
        } else {
            return Redirect::to('client');
        }
    }

    public function saveFeedback()
    {
        if (Request::isMethod('post')) {
            $postData = Input::all();
            $feedback = Feedback::Persist(array(
                'feedbacks_id' => $postData['freelancer_id'],
                'feedbacks_type' => 'Freelancer',
                'job_offer_id' => $postData['job_offer_id'],
                'feedback_score' => $postData['score'],
                'comment' => $postData['comment'],
            ));

            if ($feedback->id)
                Helpers::addMessage(200, 'you feedback submitted');

            return $feedback;
        } else {
            return Redirect::to('client');
        }
    }

    public function PhaseProgress()
    {
        $id = Request::segment(3);

        $nid = Helpers::EncodeDecode($id,false);

        $notification = Notification::find($nid);

        if(count($notification))
        {
            $jobPhase = JobPhase::find(Helpers::EncodeDecode($notification->object_id,false));
            Notification::ReadFlag(array('id'=>$nid,'read_status'=>1));
            $client = Client::find($this->user_id);
            View::share('notifications',(count($client))? $client->UnreadNotifications : array());
            $viewModel = array('client'=>$this->userAccount,'notification'=>$notification,'jobPhase'=>$jobPhase);

            return Theme::make('notification.client.phase-progress',$viewModel);
        }else{
            Helpers::addMessage(400, ' No phase progress notification found');
            return Redirect::to($this->defaultRoute);
        }
    }

    public function PaymentProcess()
    {
        $id = Request::segment(3);

        $nid = Helpers::EncodeDecode($id,false);

        $notification = Notification::find($nid);
        if(count($notification))
        {
            $jobPhase = JobPhase::find(Helpers::EncodeDecode($notification->object_id,false));

            $viewModel = array('client'=>$this->userAccount,'notification'=>$notification,'jobPhase'=>$jobPhase);
            $notification->read_status = 1;
            $notification->save();
            $client = Client::find($this->user_id);
            View::share('notifications',(count($client))? $client->UnreadNotifications : array());
            return Theme::make('notification.client.payment-process',$viewModel);
        }else{
            Helpers::addMessage(400, ' No payment process notification found');
            return Redirect::to($this->defaultRoute);
        }
    }

    public function notification()
    {
        $viewModel = array();
        $id = Helpers::EncodeDecode(Request::segment(3),false);
        $notification = Notification::find($id);
        if(count($notification))
        {
            $viewModel['notification'] = $notification;
            $notification->read_status = 1;
            $notification->save();
            $client = Client::find($this->user_id);
            View::share('notifications',(count($client))? $client->UnreadNotifications : array());
            return Theme::make('notification.client.notification',$viewModel);
        }else{
            return Redirect::to($this->defaultRoute);
        }
    }

    public function UpdatePaymentRequest()
    {
        if (Request::isMethod('post')) {
            $post_all = Input::all();

            if ($post_all['request_status'] == 'Accepted') {

            } else {
                Helpers::addMessage(400, ' Payment Request ' . $post_all['request_status']);
                $jobPhase = JobPhase::Persist(array('id' => $post_all['jpid'], 'phase_payment_status' => 'Hold'));
            }
            if(!empty($post_all['nid'])){
                $notification = Notification::find($post_all['nid']);
                if (count($notification)) {
                    $notification->read_status = 1;
                    $notification->save();
                }
            }
            return Redirect::to('client');

        } else {
            return Redirect::to('client');
        }
    }

    public function PaymentRequest(){
        $viewModel = array();
        if($this->userAccount->user_type=="Client")
            $jobOfferList = JobOffer::with('Freelancer','WaitingJobPhase')->where(array('client_id'=>$this->userAccount->user_id))->get();
        elseif($this->userAccount->user_type=="Admin")
            $jobOfferList = JobOffer::with('Freelancer','WaitingJobPhase')->get();


//        Helpers::debug(count($jobOfferList),1);
//        Helpers::debug($jobOfferList,1);
        $viewModel['jobOfferList'] = $jobOfferList;
        return Theme::make('client.payment-request',$viewModel);
    }

    public function ChangeWidgetStatus()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();

            $postData['id'] = $this->user_id;
            $postData[$post_data['field']] = (!empty($post_data['val'])) ? 1:0;
//            Helpers::debug($post_data);
//            Helpers::debug($postData,1);
            $client = Client::Persist($postData);
            if(!empty($client) && !empty($client->id)){
                return array(
                    'status'=>200,
                    'result'=>$client,
                    'msg' => array(array('Your profile settings has been changed successfully')),
                );
            }else{
                return array(
                    'status'=>400,
                    'msg' => array(array('Your profile settings has not been changed successfully')),
                );
            }
        }else{
            return Redirect::to('freelancer/overview');
        }
    }

    public function AllNotification()
    {
        $viewModel = array();
        $client = Client::find($this->userAccount->user_id);
        $viewModel['all_notifications'] = $client->Notifications()->paginate(20);
        return Theme::make('notification.client.all-notification', $viewModel);

    }

    public function finance()
    {
        $client = Client::find($this->user_id);

        if(!empty($client->id))
        {
            $payments = $client->Payments();

            $viewModel['freelancer'] = $client;
            $viewModel['payments'] = $payments;

            return Theme::make('client.payments',$viewModel);

        }else{

            Helpers::addMessage(400, ' No profile found for freelancer');
            return Redirect::to($this->defaultRoute);
        }
    }
} 