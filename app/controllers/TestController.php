<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/20/14
 * Time: 4:16 PM
 */

class TestController extends BaseController{

    protected $user;
    protected $profileUserId;
    public function __construct()
    {
        parent::__construct();

        //$this->user = Helpers::AdminToGeneralProfileAccess();
        View::share('notifications',array());
    }

    public function CustomException()
    {
        //$errorType = request::segment(2);
//phpinfo();
        $f= "sdfsdsd";



    }

    public function Index()
    {
        Helpers::debug(Helpers::CustomSession(PROFILE_USER_ID));
       // echo "sdf";
       // Helpers::debug($_SESSION);
/*
        Helpers::CustomSession();
        echo'<br />';

        Helpers::CustomSession('x',88);
        echo'<br />';

        echo Helpers::CustomSession('x');
        echo'<br />';

*/

        //  Helpers::debug(Helpers::CustomSession(PROFILE_USER_ID));

        // Helpers::CustomSession();
       Helpers::debug($this->user);

        echo "============================= <br />";

        Helpers::CustomSession(PROFILE_USER_ID,66);

     //  Helpers::debug($this->user);


        die();
        $str = "123456789";

       echo Helpers::EncodeDecode($str);
        echo'XXXX';
       echo Helpers::EncodeDecode(Helpers::EncodeDecode($str),false);



       // $string3=convert($string2,$key);
        die();
       // return $this->throttleprovider
        $userid = User::UsersList();

        helpers::debug($userid);
        die();

       // $viewmodel = array();
       // return theme::make('test.index',$viewmodel);
    }

    public  function creategroup()
    {

        // route::any('test/cg/{group}',"testcontroller@creategroup");


        $name = request::segment(3);
        echo $name;
        try
        {
            // create the group
            $group = sentry::creategroup(array(
                'name'        => $name,
                'permissions' => array(
                    $name => 1,
                ),
            ));

            print_r($group);
        }
        catch (cartalyst\Sentry\Groups\Namerequiredexception $e)
        {
            echo 'name field is required';
        }
        catch (cartalyst\Sentry\Groups\Groupexistsexception $e)
        {
            echo 'group already exists';
        }

    }

    public function assignadmin()
    {
        // route::any('test/cg/assign-admin',"testcontroller@assignadmin");

        try{
        $user = sentry::finduserbyid(2);

        $admingroup = sentry::findgroupbyid(1);

        if ($user->addgroup($admingroup))
        {
            echo " group assigned successfully";
        }
        else
        {
            echo "group was not assigned";
        }

        }
        catch (cartalyst\Sentry\Users\Usernotfoundexception $e)
        {
            echo 'user was not found.';
        }
        catch (cartalyst\Sentry\Groups\Groupnotfoundexception $e)
        {
            echo 'group was not found.';
        }


    }
        public  function test()
        {

            $contactinfo = freelancer::getfreelancerbyemail(sentry::getuser()['email']);

          // helpers::debug(sentry::getuser()['id']);
            helpers::debug($contactinfo);
        }

    public function massdataassign()
    {
        // echo "in"; die();
        //route::any('test/cg/mass',"testcontroller@massdataassign");
        $user = array();

        for($i = 0 ; $i<600 ; $i++)
        {
            $firstname = "first{$i}";
            $lastname = "first{$i}";
            $age = rand(1,100);

           $user =  testdata::firstornew(array('first_name'=>$firstname, 'last_name'=>$lastname,'age'=>$age));
            $user->save();
        }

        helpers::debug($user);
    }

    public function page()
    {
        $viewmodel = array();
        $viewmodel['testdata'] = testdata::all();

        return theme::make('test.page',$viewmodel);
    }

    public function finddata()
    {

       if(request::ismethod('post'))
       {
           //echo "in"; die();

           $item = input::get('cd');
        $userdata = testdata::where('first_name', 'like', '%'.$item.'%')
                            ->orwhere('last_name', 'like', '%'.$item.'%')
                            ->orwhere('age', 'like', '%'.$item.'%')
                            ->get();

        return $userdata;

        }

        return 1;
       // helpers::debug($userdata);

       // helpers::lastquery();
    }




} 