<?php

 class Authenticate{

    public static  function Login($params)
    {

        $viewModel = array();

            try{

                $user = Sentry::authenticate($params['credentials'],$params['remember']);
                $viewModel['user_type'] = self::CheckUserType($user);
                /*
                 * No need to add extra functionality cause we are using Sentry Package for managing login and users
                 * Session::put('authenticateUser', $user->getattributes());
                */
            }catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                $viewModel['error_msg']='Login field is required.';
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                $viewModel['error_msg']= 'Password field is required.';
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                $viewModel['error_msg']= 'Wrong password, try again.';
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                $viewModel['error_msg']= 'User was not found.';
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                $viewModel['error_msg']= 'User is not activated.';
            }

            // The following is only required if the throttling is enabled
            catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
            {
                $viewModel['error_msg']= 'User is suspended.';
            }
            catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
            {
                $viewModel['error_msg']= 'User is banned.';
            }

        return $viewModel;

    }

     private static function CheckUserType($user)
     {

         if($user->user_type ==='Admin')
             $userType ='admin';
         elseif($user->user_type ==='Freelancer')
             $userType ='freelancer';
         elseif($user->user_type ==='Client')
             $userType ='client';

         return $userType;
     }

     public static function CheckDomainAuthorization($userType)
     {
         if(($_SERVER['SERVER_NAME']==FREELANCER_DOMAIN) && ($userType == 'admin' || $userType == 'client'))
         {
             return true;

         }elseif($_SERVER['SERVER_NAME']==CLIENT_DOMAIN && $userType == 'freelancer')
         {
             return true;

         }
         return false;
     }

}
