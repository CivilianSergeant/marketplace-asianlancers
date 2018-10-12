<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 2/13/14
 * Time: 2:38 PM
 */

class Helpers {

    /**
     * Render last query
     * @param $print
     * @return mixed
     */
    public static function LastQuery($print=1)
    {
        $queries = DB::getQueryLog();
        $last_query = end($queries);
        if($print)
            echo'<pre>'. print_r($last_query);
        else
            return $last_query;
    }

    /**
     * @param $data
     * @param int $die if set to 1 it will die() out immediately
     * @param int $flag used to print as var_dump if set to 1
     * @param string $msg
     */
    public static function debug($data,$die=0,$flag=0,$msg='')
    {
        echo '<pre>';
        echo 'Debuging...';
        if(!empty($msg))
        {
            echo '<br/>'.$msg;
        }
        echo '<br/>';

        if($flag){
            var_dump($data);
        }else{
            print_r($data);
        }

        echo '</pre>';
        if($die==1)
            die();
    }

    /**
     * set custom representation format for date or time
     * @param $format
     * @param $date
     * @return bool|string
     */
    public static function dateTimeFormat($format,$date)
    {
        return date($format,strtotime($date));
    }

    /**
     * add Success, Warning  or Error Message
     * @param $status
     * @param $msg
     * @return mixed
     */
    public static function addMessage($status,$msg)
    {
        $errorMessage = new ErrorMessage($status,$msg);
        $user = Sentry::getUser();
        $key = (count($user)>0)? $user->email.'_'.$user->user_id : 'guest';
        return Session::put($key.'_msg',$errorMessage->toArray());

    }

    /**
     * get Success, Warning or Error Message
     * @return string
     */
    public static function getMessage()
    {
        $user = Sentry::getUser();
        $key = (count($user)>0)? $user->email.'_'.$user->user_id : 'guest';
        $message = Session::get($key.'_msg');

        if(!empty($message) && $message['status'] == 200)       // for success
        {
            return '<div class="alert alert-success fade in">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <strong>Success !</strong> '.$message['message'].'
                            </div>';
        }else if(!empty($message) && $message['status'] == 400){        // for warning
            return '<div class="alert alert-warning fade in">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <strong>Warning!</strong> '.$message['message'].'
                            </div>';

        }else if(!empty($message) && $message['status'] == 500){       // for error
            return '<div class="alert alert-block alert-danger fade in">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <strong>Sorry !</strong> '.$message['message'].'
            </div>';
        }
    }

    /**
     * clear any message stored in session
     * @return mixed
     */
    public static function clearMessage()
    {
        $user = Sentry::getUser();
        $key = (count($user)>0)? $user->email.'_'.$user->user_id : 'guest';
        return Session::put($key.'_msg',array());
    }


    public static function showMessage()
    {
        echo self::getMessage();
        self::clearMessage();
    }


    public static function processMessage($data,$template)
    {
        foreach ($data as $k => $arr) {
            $template = preg_replace('/{' . $k . '}/', $data[$k], $template);
        }
        return $template;
    }

    /**
     * Encode and decode a string
     * @param $string
     * @param bool $isEncode
     * @param int $loop
     * @return string
     */
    public static function EncodeDecode($string ,$isEncode=true,$loop=2)
    {
        $string = ($isEncode == false)? '=='.$string : $string;
        for($i=0; $i<$loop;$i++)
        {
            $string = $isEncode ? strrev(base64_encode($string)):base64_decode(strrev($string));
        }
//        $string = $isEncode ? substr($string,2) : $string;
        return $string;
    }


    public static function CustomSession($key = null, $value = null)
    {

        if(!isset($_SESSION)){
            session_start();

        }

        if (!isset($value) && !isset($key))
        {
            session_destroy();

        }
        elseif(!isset($_SESSION[$key]) && !empty($value))
        {
            $_SESSION[$key] = $value;

        }
        elseif(!empty($_SESSION[$key]) && !empty($value))
        {
            $_SESSION[$key] = $value;

        }
        elseif (!empty($_SESSION[$key]) && $value == null )
        {

            return (!empty($_SESSION[$key]))?$_SESSION[$key]:null;

        }


    }

    public static function userAuthentication($email,$password)
    {
        $user = array();
        try
        {
            // Login credentials
            $credentials = array(
                'email'    => $email,
                'password' => $password,
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return 'Wrong password, try again.';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return 'User was not found.';
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return 'User is not activated.';
        }

// The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            echo 'User is suspended.';
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            echo 'User is banned.';
        }

        return $user;
    }


    public static function defaultTimeZone()
    {
        date_default_timezone_set('Asia/Dhaka');
    }


    public static function AdminToGeneralProfileAccess()
    {

        /*
         * invoke session through :  Helpers::CustomSession(PROFILE_USER_ID,66);
         *
         * */

        $user = Sentry::getUser();
        try
        {
            if(!empty($user))
            {
               $permissions =$user->getMergedPermissions();

               $profileUserId = Helpers::CustomSession(PROFILE_USER_ID);

                if(isset($permissions['Admin']))
                {
                    if(($permissions['Admin']==1) && !empty($profileUserId) )
                    {
                        $user = Sentry::findUserByID($profileUserId);
                    }
                }
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            echo 'User was not found.';
        }

        return $user;
    }

    public static function AssignPermission($user)
    {
        // Assign user to group
        if($user['user_type'] == 'Admin')
            Sentry::findUserByID($user->id)->addGroup(Sentry::findGroupByName('Admin'));
        elseif($user['user_type'] == 'Client')
            Sentry::findUserByID($user->id)->addGroup(Sentry::findGroupByName('Client'));
        elseif($user['user_type'] == 'Freelancer' && $user['is_agent'] == 1 )
            Sentry::findUserByID($user->id)->addGroup(Sentry::findGroupByName('Agency'));
        else
            Sentry::findUserByID($user->id)->addGroup(Sentry::findGroupByName('Individual'));

    }

    public static  function BuildProfile($type,$user,$companyName="")
    {
        switch ($type){
            case 'A':
                $userAgent = Freelancer::firstOrNew(
                    array(  'first_name'=>$user['first_name'],
                        'last_name'=>$user['last_name'],
                        'agency_name'=>$companyName,
                        'freelancer_type'=>'Agency',
                        'freelancer_price'=>'0',
                        'publish_status'=>'1',
                        'email'=>$user['email'],
                        'available' => 1
                    )
                );
                $userAgent->save();
                $user->user_id = $userAgent->id;
                $user->save();
                break;
            case 'F':
                $userIndividual = Freelancer::firstOrNew(
                    array(  'first_name'=>$user['first_name'],
                        'last_name'=>$user['last_name'],
                        'agency_name'=>'',
                        'freelancer_type'=>'Individual',
                        'freelancer_price'=>'0',
                        'publish_status'=>'1',
                        'email'=>$user['email'],
                        'available' => 1
                    )
                );
                $userIndividual->save();
                $user->user_id = $userIndividual->id;
                $user->save();
                break;

            case'C':
                $userClient = Client::firstOrNew(
                    array(
                        'first_name'=>$user['first_name'],
                        'last_name'=>$user['last_name'],
                        'email'=>$user['email']
                    )
                );
                $userClient->client_status  = 'Active';
                $userClient->save();
                $user->user_id = $userClient->id;
                $user->save();
                break;
        }

    }

    public static function CheckDomain()
    {
        return ($_SERVER['SERVER_NAME']===FREELANCER_DOMAIN) ? true : false;
    }

} 