<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    protected $layout;
    protected $currentLanguage;

    public function __construct()
    {
        //remember to replace http part
        ($_SERVER['SERVER_NAME']===str_replace("http://",'',FREELANCER_DOMAIN)) ?
                        Theme::setLayout('freelancer') : Theme::setLayout('default');

        $this->layout = Theme::getLayout() ;
        View::share('theme',Theme::getTheme());
        View::share('title',Theme::getTitle());

        /**
         * Top Search bar of all page and home page need job categories
         */
        $jobCategories = JobCategory::where('display',1)->get();
        View::share('job_categories',$jobCategories);

        /**
         *  Sentry::getUser() will fetch current logged in user from session if user visits in admin section
         * else Helpers::AdminToGeneralProfileAccess() will set the selected user as current user.
         */


        $currentUser = Sentry::getUser();
        View::share('authenticateUserInfo',$currentUser);


        $this->currentLanguage = Session::get("lang");
        View::share("lang",$this->currentLanguage);
    }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
}
