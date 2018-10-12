<?php

class PageController extends BaseController
{
	protected $loginUser;
    protected $user_id;

    public function __construct()
    {
//        parent::__construct();
//		$this->loginUser = Sentry::getUser();
        parent::__construct();
        $loggedUser = Helpers::AdminToGeneralProfileAccess();//Sentry::getUser();

        $this->loginUser = $loggedUser;

        $this->user_id = $this->loginUser->user_id;

        View::share('authenticateUserInfo',$loggedUser);
        if($this->loginUser->user_type=='Client')
            $client = Client::find($this->user_id);
        else
            $client = Sentry::getUser();
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
        View::share('notifications',(count($client))? $client->UnreadNotifications : array());
    }

    public function index()
    {
    	return Redirect::to('page/lists');
    }

    public function lists()
    {
    	$viewModel = array();
    	$viewModel['pages'] = Page::all();
    	return Theme::make('page.list',$viewModel);
    }

    public function create($id='')
    {
    	$viewModel = array();

        $viewModel['page_types'] = Page::$PAGE_TYPES;

    	if(empty($id))
        {
            return Theme::make('page.create',$viewModel);
        }
        else
        {
            $id = Helpers::EncodeDecode($id,false);
            $viewModel['page'] = Page::find($id);
            return Theme::make('page.edit',$viewModel);
        }
    }

    public function updatePage()
    {
        if(Request::isMethod('post'))
        {
            $post_all = Input::all();
            $id = Helpers::EncodeDecode($post_all['id'],false);
            /*Helpers::debug($post_all);
            Helpers::debug($id,1);*/
            $post_all['url'] = strtolower(str_replace(array('?','.',' '),"-",$post_all['title'])).'.html';
            $page = Page::where('id',$id)->update(array('title'=>$post_all['title'],'url'=>$post_all['url'],'page_type'=>$post_all['page_type'],'description'=>$post_all['description'],'excerpt'=>$post_all['excerpt']));
            Helpers::addMessage(200,'Page information updated');
        }
        else
        {
            Helpers::addMessage(400,'Sorry Cannot update');
        }  
        return Redirect::to('page'); 
    }

    public function delete($id)
    {
        $id = Helpers::EncodeDecode($id,false);
        $page = Page::find($id);
        if(count($page))
        {
           $page->delete();
        }
        return Redirect::to('page');
    }

    public function savePage()
    {
    	if(Request::isMethod('post'))
    	{
    		$post_all = Input::all();
    		$page_url = strtolower(str_replace(array('?','.',' '),"-",$post_all['title'])).'.html';
            $page_type = $post_all['page_type'];

    		$page = Page::firstOrNew(array('url'=>$page_url,'page_type'=>$page_type));

    		$page->title       = $post_all['title'];
    		$page->description = $post_all['description'];
    		$page->excerpt     = $post_all['excerpt'];
    		$page->save();
    	}
    	return Redirect::to('page');
    }
}