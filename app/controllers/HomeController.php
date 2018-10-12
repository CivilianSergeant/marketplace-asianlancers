<?php

class HomeController extends BaseController
{


    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */



    public function __construct()
    {
        parent::__construct();
        /*$this->currentLanguage = Session::get("lang");
        View::share("lang",$this->currentLanguage);*/
    }

    public function Index()
    {
        $viewModel = array();

        $fontView = "front.index";
        if ($_SERVER['SERVER_NAME'] === FREELANCER_DOMAIN) {
            $fontView = "front.freelancer";

            $viewModel['notifications'] = array();

        } else {
            $viewModel['pages'] = Page::where('page_type',PAGE::$CLIENT)->orderBy('id','desc')->take(3)->get();

            $viewModel['job_categories'] = JobCategory::all();

        }
        Session::put('job_create_flag',array());
        $viewModel['total_jobs'] = JobPost::where('job_status','!=','Pending')->where('deleted_at',NULL)->count();
        $viewModel['total_paid'] = 750;
        $viewModel['total_freelancers'] = Freelancer::where('deleted_at',NULL)->count();
        $viewModel['total_clients']     = Client::where('deleted_at',NULL)->count();

      //  Helpers::debug($viewModel['total_clients']);die();
        return Theme::make($fontView, $viewModel);

    }

    public function setLang() {

        if(Request::isMethod('post'))
        {
            $postData = Input::all();

            if(isset($postData['lang']))
            {
                Session::put("lang", $postData['lang']);
            }


            $url = Input::get("url");
            return Redirect::to($url);

        }else{
            return Redirect::to('home');
        }




    }

    public function Price()
    {
        $viewModel = array();

        $flag = Theme::getSessionData('job_create_flag');
        if(array_search('home',$flag)===false)
            return Redirect::to('/');

        $jobPrices = JobPriceCategory::all();

        foreach ($jobPrices as $key => $jobPrice) {
            $jobPrices[$key]['availableFreelancer'] = Freelancer::where('freelancer_price', $jobPrice->title)->where('available', 1)->count();
        }
        //Helpers::debug($jobPrices,1);
        $viewModel['job_prices'] = $jobPrices;
        return Theme::make('front.price', $viewModel);
    }

    public function SetPageFlag(){
        if(Request::isMethod('post'))
        {
            $postData = Input::all();
            $pageFlag = Session::get('job_create_flag');
            Session::put('job_create_flag',array_merge($pageFlag,array(Input::get('page_name'))));
            $cat = array();
            if(!empty($postData['cat_id']))
                $cat = JobCategory::find(Input::get('cat_id'));

            if(count($cat)){
                return array(
                    'status'=>'200',
                    'url' =>'price/'.Helpers::EncodeDecode($cat->id),
                );
            }else{
                return array(
                    'status'=>'200',
                );
            }

        }else{
            return array(
                'status'=>'400',
            );
        }
    }

    public function SignUp()
    {
        $viewModel = array();
        /*try{
            $client = Sentry::createUser(array(
                'email'      => 'you@you.com',
                'password'   => '12345678',
                'first_name' => 'Admin',
                'last_name'  => 'Admin',
                'user_type' => 'Admin',
                'activated'  => true,
            ));

        }catch(\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo $e->getMessage();
        }*/
        return Theme::make('front.register', $viewModel);
    }

    public function SignUpFreelancer()
    {


        $viewModel = array('valid_msg' => array());
        if (Request::isMethod('post')) {
            $post_data = Input::all();
            $valid_msg = RegisterValidator::validate($post_data);
            if (is_array($valid_msg) && empty($valid_msg)) {

                try {
                    $freelance = Sentry::createUser(array(
                        'email' => $post_data['email'],
                        'password' => $post_data['password'],
                        'first_name' => $post_data['first_name'],
                        'last_name' => $post_data['last_name'],
                        'user_type' => 'Freelancer',
                        'is_agent' => ((isset($post_data['agency'])) == true ? 1 : 0),
                        'activated' => false
                    ));
                    $activationCode = $freelance->getActivationCode();

                    Helpers::AssignPermission($freelance);

                    // redirect or show confirm message
                    $viewModel ['success_msg'] = "Your account has been created successfully. Confirmation link sent to your {$post_data['email']}.";

                    // send mail
                    $data = array(
                        'name' => $post_data['first_name'] . ' ' . $post_data['last_name'], 'id' => $freelance->id,
                        'activation_code' => urlencode($activationCode),
                        'type' => ((isset($post_data['agency'])) == true ? 'A' : 'F'),

                        'company' => isset($post_data['company-name']) == true ? urlencode($post_data['company-name']) : '',
                    );

                    // Mail::send('emails.activation.signup', $data, function($message)
                    Mail::queue('emails.activation.signup', $data, function ($message) {
                        $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))->subject('Welcome to Market Place');
                    });
                    return Theme::make('front.register-freelancer', $viewModel);

                } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
                    echo $e->getMessage();
                }
            } else {
                $viewModel = array('valid_msg' => $valid_msg);
                return Theme::make('front.register-freelancer', $viewModel);
            }
        } else {
            return Theme::make('front.register-freelancer', $viewModel);
        }
    }

    public function SignUpClient()
    {
        $viewModel = array('valid_msg' => array());
        //$image = base64_encode(file_get_contents('http://client.marketplace/public/themes/default/img/logo.png'));
        // echo '<img src="data:image/png;base64,'.base64_encode($image).'" />'; die();
        if (Request::isMethod('post')) {
            //Helpers::debug(Input::all());
            $post_data = Input::all();
            $valid_msg = RegisterValidator::validate($post_data);
            if (is_array($valid_msg) && empty($valid_msg)) {
                try {
                    $client = Sentry::createUser(array(
                        'email' => $post_data['email'],
                        'password' => $post_data['password'],
                        'first_name' => $post_data['first_name'],
                        'last_name' => $post_data['last_name'],
                        'user_type' => 'Client',
                        'activated' => false
                    ));
                    $activationCode = $client->getActivationCode();

                    Helpers::AssignPermission($client);

                    // redirect or show confirm message
                    $viewModel ['success_msg'] = "Your account has been created successfully. Confirmation link sent to your {$post_data['email']}.";

                    // send mail
                    $data = array(
                        'name' => $post_data['first_name'] . ' ' . $post_data['last_name'], 
                        'id' => $client->id,
                        'activation_code' => $activationCode,
                        'type' => 'C',
                        'company' => (isset($post_data['company-name']) == true) ? urlencode($post_data['company-name']) : '',
                        
                    );

                    //  Mail::send('emails.activation.signup', $data, function($message)
                    Mail::queue('emails.activation.signup', $data, function ($message) {
                        $message->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))->subject('Welcome to Market Place');                  
                    });

                    return Theme::make('front.register-client', $viewModel);

                } catch (\Cartalyst\Sentry\Users\UserExistsException $e) {
                    echo $e->getMessage();
                }
            } else {
                $viewModel = array('valid_msg' => $valid_msg);
                return Theme::make('front.register-client', $viewModel);
            }
        } else {
            return Theme::make('front.register-client', $viewModel);
        }
    }

    public function Login()
    {
       // phpinfo();die();
        $viewModel = array();
        $user = Sentry::getUser();

        if (count($user)) {


            switch ($user->user_type) {
                case 'Admin' :
                    return Redirect::to('admin');
                    break;
                case 'Freelancer':
                    return Redirect::to('freelancer/overview');
                    break;
                case 'Client':

                    return Redirect::to('client');
                    break;
            }
        }
        if (Request::isMethod('post')) {
            $credentials = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            $remember = ((Input::get('remember_me')) == null ? false : true);

            $params = array('credentials' => $credentials, 'remember' => $remember);

            $viewModel = Authenticate::Login($params);

            // only authorized user will be redirected - Tanvir.
            if (!empty($viewModel['user_type'])) {

                if(Authenticate::CheckDomainAuthorization($viewModel['user_type']))
                {
                    $this->Logout();
                    Helpers::addMessage(400, " Authorization failed");
                    return Redirect::to('home/login');

                }
                $rurl = Session::get('rurl');
                if (!empty($rurl)) {
                    Session::forget('rurl');
                    return Redirect::to($rurl);
                } else
                    return Redirect::to($viewModel['user_type']);
            }

            return Theme::make('front.login', $viewModel);
        } else {
            return Theme::make('front.login', $viewModel);
        }

    }

    public function Activate()
    {

        $viewModel = array();
        $code = urldecode(Request::segment(4));
        $companyName = urldecode(Request::segment(6));

        try {
            // Find the user using the user id
            $user = Sentry::findUserById(Request::segment(3));

            // Attempt to activate the user
            if ($user->attemptActivation($code)) {

                Helpers::BuildProfile(Request::segment(5), $user, $companyName);

                // User activation passed
                $viewModel['success_msg'] = 'Thank you for active your account. Now you can login into your account.
                If any problem occur when you want to login then please contact to our support team';
            } else {
                // User activation failed
                $viewModel['error_msg'] = 'Sorry! your link is not right for activation.So, your account is not activate.
                Please contact to our support team';
                //return Theme::make('front.activate', $viewModel);
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $viewModel['error_msg'] = 'User was not found.';
        } catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {
            $viewModel['error_msg'] = 'User is already activated.';
        }
        return Theme::make('front.activate', $viewModel);
    }

    public function ForgetPasswordView()
    {
        if (Request::isMethod('post')) {
            // die('sdfsdf');
            $response = array();
            $email = Input::get('email');

            //$validator = array();

            $validator = Validator::make(array('email' => $email), array('email' => 'email'));

            if ($validator->fails()) {
                $response['status'] = 'Error';

                $response['message'] = 'Email validation failed !';

                return $response;
            } else {

                try {
                    // Find the user using the user email address
                    $user = Sentry::findUserByLogin($email);

                    // Get the password reset code
                    $resetCode = $user->getResetPasswordCode();

                    // send mail
                    $data = array(
                        'name' => $user['first_name'] . ' ' . $user['last_name'],
                        'id' => Helpers::EncodeDecode($user['id']),
                        'activation_code' => $resetCode,
                    );

                    //  Mail::send('emails.activation.signup', $data, function($message) use ($user)
                    Mail::queue('emails.activation.reset', $data, function ($message) use ($user) {
                        $message->to(Input::get('email'), $user['first_name'] . ' ' . $user['last_name'])->subject('Market place - Reset your password');
                    });

                    $response['status'] = 'Success';

                    $response['message'] = 'Please check your email';

                    return $response;


                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    $response['status'] = 'Error';

                    $response['message'] = 'User not found in our system !';

                    return $response;
                }

            }

        } else {
            $viewModel = array();
            return Theme::make('front.forget-password-view', $viewModel);
        }

    }

    public function RestPassword()
    {
        $id = urldecode(Request::segment(3));
        $code = urldecode(Request::segment(4));
        $request = Input::all();
        $response = array();

        if (Request::isMethod('post')) {
            if ($request['password'] != $request['confPassword']) {
                $response['status'] = 'Error';
                $response['message'] = "Password not matched";
                return $response;
            } else {

                $id = Helpers::EncodeDecode($request['id'], false);

                try {
                    $user = Sentry::findUserById($id);
                    // Check if the reset password code is valid
                    if ($user->checkResetPasswordCode($request['code'])) {
                        // Attempt to reset the user password
                        if ($user->attemptResetPassword($request['code'], $request['password'])) {

                            $response['status'] = 'Success';
                            $response['message'] = "Password changed successfully.";
                            return $response;
                            // Password reset passed
                        } else {
                            $response['status'] = 'Error';
                            $response['message'] = "Password reset failed !";
                            return $response;
                        }
                    } else {
                        $response['status'] = 'Error';
                        $response['message'] = "The provided password reset code is Invalid !";
                        return $response;
                    }
                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    $response['status'] = 'Error';
                    $response['message'] = "User was not found !";
                    return $response;
                }
            }
        } else {
            $viewModel['id'] = $id; //array();
            $viewModel['code'] = $code;
            return Theme::make('front.reset-password-view', $viewModel);
        }
    }

    public function Logout()
    {
        Helpers::CustomSession();

        Sentry::logout();

        return Redirect::to('home/login');
    }


}
