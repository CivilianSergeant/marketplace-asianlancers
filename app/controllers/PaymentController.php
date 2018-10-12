<?php

class PaymentController extends BaseController {

    protected $layout;

    /**
     * for set default route
     * @var string
     */
    protected $default_route;

    /**
     * for set user session data
     * @var string
     */
    protected $_userSession;

    //protected $pageLimit;

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

    public function index() {
        return Redirect::to('agreement/lists');
    }

    public function paynow() {
        $id = Request::segment(3);

        $nid = Helpers::EncodeDecode($id,false);
        $phaseInfo = JobPhase::find($nid);


        if (count($phaseInfo) && $phaseInfo->phase_payment_status == 'Waiting') {
            $viewModel['jobOffer'] = JobOffer::with('Freelancer')->find($phaseInfo->job_offer_id);
            $viewModel['phaseInfo'] = $phaseInfo;
            return Theme::make('payment.index', $viewModel);
        } else {
            Helpers::addMessage(400, "There are no phase payment found");
            return Redirect::to('client');
        }
    }

    public function approve() {
        if (Request::isMethod('post')) {


            $post_data = Input::all();

            $totalPrice = $post_data['price'];
            $totalHourWorked= $post_data['hour'];
            $bonus = (!empty($post_data['bonus']))? $post_data['bonus']:0;
            $fid = Helpers::EncodeDecode($post_data['fid'],false);
            $joid = Helpers::EncodeDecode($post_data['joid'],false);
            $jpid = Helpers::EncodeDecode($post_data['jpid'],false);

            $freelancer = Freelancer::find($fid);
            $jobOffer = JobOffer::find($joid);
            $jobPhase = JobPhase::find($jpid);

            $totalPrice = (!empty($bonus)) ? ($totalPrice + $bonus) : $totalPrice;
            if(!count($freelancer) && !count($jobOffer))
            {
                return Redirect::to('payment/paynow/' . Helpers::EncodeDecode($jpid))->withInput();
            }   //Helpers::debug($post_data,1);

            if (!is_numeric($totalPrice)) {
                Helpers::addMessage(400, " Amount must be in number");
                return Redirect::to('payment/paynow/' . Helpers::EncodeDecode($jpid))->withInput();
            }
            if (count($jobOffer)) {


                $jobOfferTitle = $jobOffer->title;
                $sdkConfig = array(
                    "mode" => "sandbox"
                );
                $clientId = "AWmkcBD3ZI_nzHw7an0nSfeCNiCBjks7t93F6HOhPRxB4jv8iFqTg_18HGNZ";
                $secretCode = "ENwr9xDBjY52u3aZAzeXZdYGhzMt5KeXPT7Ib7zGtYnlo77XPJkaY8QjHur5";
                $cred = new OAuthTokenCredential($clientId, $secretCode, $sdkConfig);
                $accessToken = $cred->getAccessToken($sdkConfig);


                $apiContext = new ApiContext($cred, 'Request' . time());
                $apiContext->setConfig($sdkConfig);

                $payer = new Payer();
                $payer->setPaymentMethod("paypal");

                $amount = new Amount();
                $amount->setCurrency("USD");
                $amount->setTotal("$totalPrice");

                $item = new Item();
                $item->setQuantity(1);
                $item->setName("$jobOfferTitle");
                $item->setPrice("$totalPrice");
                $item->setCurrency("USD");

                $itemList = new ItemList();
                $itemList->setItems(array($item));

                $transaction = new Transaction();
                $transaction->setDescription("Your Payment for phase: ".$jobPhase->phase_title." total hour worked:".$totalHourWorked);

                $transaction->setAmount($amount);
                $transaction->setItemList($itemList);



                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl(url('payment/success/') . '?JobOfferId=' . Helpers::EncodeDecode($jobOffer->id).'&phase='.Helpers::EncodeDecode($jpid));
                $redirectUrls->setCancelUrl(url('payment/cancel/') . '?JobOfferId=' . Helpers::EncodeDecode($jobOffer->id).'&phase='.Helpers::EncodeDecode($jpid));
                $payment = new Payment();
                $payment->setIntent("sale");
                $payment->setPayer($payer);
                $payment->setRedirectUrls($redirectUrls);
                $payment->setTransactions(array($transaction));
                $payment->create($apiContext);

                $linkObj = '';
                foreach ($payment->getLinks() as $link) {
                    if ($link->rel == 'approval_url') {
                        $linkObj = $link;
                        break;
                    }
                }

                Session::put('paymentid', $payment->id);

                date_default_timezone_set('Asia/Dhaka');
                $agreementPayment = Payments::Persist(array(
                    'job_offer_id' => $jobOffer->id,
                    'job_phase_id' => $jpid,
                    'client_id'    => $jobOffer->client_id,
                    'freelancer_id' => $jobOffer->freelancer_id,
                    'amount' => $totalPrice,
                    'payment_id' => $payment->id,
                    'payment_status'  => "Processing",
                    'release_dt' => date('Y-m-d'),
                    'paid_dt' => ''
                ));

                return Redirect::to($linkObj->href);

                exit(1);

            } else {
                Helpers::addMessage(400, " Agreement not found or not accepted by Candidate");
                return Redirect::to('agreement/lists');
            }
        } else {
            Helpers::addMessage(500, " Bad Request");
            return Redirect::to('agreement/lists');
        }
    }

    public function success() {

        $sdkConfig = array(
            "mode" => "sandbox"
        );
        $clientId = "AWmkcBD3ZI_nzHw7an0nSfeCNiCBjks7t93F6HOhPRxB4jv8iFqTg_18HGNZ";
        $secretCode = "ENwr9xDBjY52u3aZAzeXZdYGhzMt5KeXPT7Ib7zGtYnlo77XPJkaY8QjHur5";

        $cred = new OAuthTokenCredential($clientId, $secretCode, $sdkConfig);

        $apiContext = new ApiContext($cred);
        $apiContext->setConfig($sdkConfig);
        $payerId = Request::get('PayerID');
        $paymentId = session::get('paymentid');
        $jobOfferId = Request::get('JobOfferId');
        $jobPhaseID = Request::get('phase');
        $jobOfferId = Helpers::EncodeDecode($jobOfferId,false);
        $jobPhaseID = Helpers::EncodeDecode($jobPhaseID,false);
        $jobOffer = JobOffer::find($jobOfferId);
        $jobPhase = JobPhase::find($jobPhaseID);

        $viewModel = array(
            'theme' => Theme::getTheme(),
            'user' => $this->_userSession
        );

        if (!empty($payerId) && !empty($paymentId) && !empty($jobOffer->id)){
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);
            try {

                $payment->execute($execution, $apiContext);


                $transactions = $payment->getTransactions();


                $amount = '';
                $description = '';
                if (count($transactions)) {
                    foreach ($transactions as $transaction) {

                        $description = $transaction->getDescription();

                        $amount = ($transaction->amount->getTotal());
                    }
                }

                date_default_timezone_set('Asia/Dhaka');
                $paymentObj = Payments::where('payment_id',$paymentId)->where('payment_status','Processing')->first();

                Payments::where('payment_id',$paymentId)->update(array('payment_status'=>"Pending","paid_dt"=>date("Y-m-d")));



                if($paymentObj->id)
                {

                    $data = array(

                        'read_status' => 0,
                        'notification_type' => 'Payment',
                        'object_id'   => Helpers::EncodeDecode($paymentObj->id)
                    );
                    $admins = Admin::all();
                    $user = $this->userAccount;

                    if($user->user_type == 'Client')
                    {
                        $client = Client::find($user->user_id);

                        if(count($admins))
                        {
                            foreach($admins as $admin)
                            {
                                $msgbody = 'A Payment made by Client <b>'.$client->getName().'</b>';
                                $data['url'] = 'admin/payment';
                                $data['sender_id']  = $client->id;
                                $data['sender_type']  = 'Client';
                                $data['receiver_type']  = 'Admin';
                                $data['receiver_id'] = $admin->id;
                                $data['subject']     = 'Payment made by client';
                                $data['message']     = $msgbody;

                                Notification::Persist($data);
                            }
                        }

                        $msgbody = 'A Payment made by Client <b>'.$client->getName().'</b>';
                        $data['url'] = 'payment';
                        $data['sender_id']  = $client->id;
                        $data['sender_type']  = 'Client';
                        $data['receiver_type']  = 'Freelancer';
                        $data['receiver_id'] = $paymentObj->freelancer_id;
                        $data['subject']     = 'Payment made by client';
                        $data['message']     = $msgbody;

                        Notification::Persist($data);
                    }
                    $jobPhase->phase_payment_status = 'Done';
                    $jobPhase->save();
                }

                $viewModel['jobOffer'] = $jobOffer;
                $viewModel['jobPhase'] = $jobPhase;
                $viewModel['freelancer'] = $jobOffer->Freelancer;
                $viewModel['client'] = $jobOffer->Client;
                $viewModel['description'] = $description;
                $viewModel['amount'] = $amount;

                return Theme::make('payment.payment-success', $viewModel);
            } Catch (Exception $ex) {
                return Theme::make('payment.payment-expired', $viewModel);
            }
        }
    }
    
    public function paymentApprove(){
        
        $viewModel = array(
            'theme' => Theme::getTheme(),
            'user' => $this->_userSession
        );
        $viewModel["payments"]=  Payments::paginate(20);
                        return Theme::make('payment.payment-approve', $viewModel);
        
    }

    public function paidCancel(){
        
        if (Request::ajax()) {
            $user = $this->_userSession;
            $sender_id = $user->id;
            $user_id = $user->user_id;
            $user_type = $user->user_type;
            $dataId = Input::get('dataId');
            $id = AgreementBLL::cancelPaid('Canceled',$dataId);

            return $id;
        }
    }
    
    public function paidAmount(){
        if (Request::ajax()) {
            $user = $this->_userSession;
            $sender_id = $user->id;
            $user_id = $user->user_id;
            $user_type = $user->user_type;
            $dataId = Input::get('dataId');
            $id = AgreementBLL::paymentPaid('Paid', $dataId);

            return $id;
        }
        
    }

        public function cancel() {
        Helpers::addMessage(400, ' Your request for payment was canceled, please try again later');
            $phaseId = Request::get('phase');
        return Redirect::to('payment/paynow/'.$phaseId);
    }

}