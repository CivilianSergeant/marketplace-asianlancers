<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 2/16/14
 * Time: 3:58 PM
 */

class Theme {

    protected static $theme = 'default';


    protected static function getConfig($fileName)
    {
        return require 'app/config/'.$fileName.'.php';
    }

    public static function make($view,$viewModel=array())
    {

        $template = 'templates.'.self::$theme;

        try{
            // For vendor specific custom changed view
            return View::make('templates.custom.'.$view, $viewModel);

        }catch(Exception $ex)
        {
            // For Default view
            return View::make($template.'.'.$view, $viewModel);
        }

    }

    public static function getLayout()
    {
        return 'templates.'.self::$theme.'.'.self::$theme;
    }

    public static function setLayout($layout)
    {
        self::$theme = $layout;

    }

    public static function getTheme()
    {
        return Request::root() . '/public/themes/'.self::$theme.'/';
    }



    public static function getTitle(){
        $config = self::getConfig('theme');
        $controller_name=Request::segment(1);
        $method_name=Request::segment(2);

        if(!empty($config[$controller_name][$method_name])){

            $config[$controller_name][$method_name]['title']=$config[$controller_name][$method_name]['title'].' '.$config['separator'].' '.$config['main_title'];
            return $config[$controller_name][$method_name];

        }else{

            return array(
                        'title'=>$config['main_title'],
                        'meta_description' => ''
                    );

        }

    }

    /**
     * @param $role 'freelancer' | 'client' | 'admin'
     * @param $menuType 'main' | 'popup'
     */
    public static function getMenu($role,$menuType)
    {
        $config = self::getConfig('menu');
        $items =  $config[$role][$menuType];
        $currentLang = Session::get("lang");
        $selectedPage = Request::segment(2);
        $selectedPage = (!empty($selectedPage))? $selectedPage: Request::segment(1);

        foreach($items as $mk => $menu)
        {
            $profileUserId = Helpers::CustomSession(PROFILE_USER_ID);

            if($mk == 'login-admin' && empty($profileUserId))
            {
                continue;
            }

            $user = Sentry::getUser();
            if($user->is_agent == 1 && $mk == 'agencies')
                continue;

            echo '<li ';
                if(!empty($selectedPage) && $mk == $selectedPage)
                    echo 'class="pi-active"';
            echo ' ><a href="'.url($menu['route']).'">';
            if(!empty($menu['icon']))
            echo '<i class="'.$menu['icon'].'"></i>';
            echo Translate::getReturn($menu['title'],$currentLang).'</a></li>';
        }
    }

    public static function getSessionData($key=null)
    {
        if(!empty($key)){
            if (Session::has($key))
            {
                return  Session::get($key);
            }
        }else{
            return  Session::all();
        }
    }

    public static function getUploadAbsolutePath($type = null){
        $config = self::getConfig('theme');

        if(!empty($type)){
            return base_path().'/'.$config['upload_file_path'][$type];
        }else{
            return  base_path();
        }
    }

    public static function getDownloadAbsolutePath($type = null){
        $config = self::getConfig('theme');

        if(!empty($type)){
            return base_path().'/'.$config['upload_file_path'][$type];
        }else{
            return  base_path();
        }
    }

    public static function getDownloadRelativePath($type = null){
        $config = self::getConfig('theme');

        if(!empty($type)){
            return url('/').'/'.$config['upload_file_path'][$type];
        }else{
            return  url('/');
        }
    }
} 