<?php

class WidgetController extends BaseController
{
	protected $loginUser;
    protected $user_id;

    public function __construct()
    {
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
    	return Redirect::to('widget/lists');
    }

    public function lists()
    {
    	$viewModel = array();
    	$viewModel['widgets'] = Widget::all();
    	return Theme::make('widget.list',$viewModel);
    }

    public function create($id='')
    {
    	$viewModel = array();

        $viewModel['types']     = Widget::$TYPES;
        $viewModel['locations'] = Widget::$LOCATIONS;

    	if(empty($id))
        {
            return Theme::make('widget.create',$viewModel);
        }
        else
        {
            $id = Helpers::EncodeDecode($id,false);
            $viewModel['widget'] = Widget::find($id);
            return Theme::make('widget.edit',$viewModel);
        }
    }

    public function saveWidget()
    {
    	if(Request::isMethod('post'))
    	{
    		$post_all = Input::all();
    		$widget_name = strtolower(str_replace(array('?','.','_',' '),"-",$post_all['title'])).'';
            
    		$widget = Widget::firstOrNew(array('widget_name'=>$widget_name,'type'=>$post_all['type'],'location'=>$post_all['location']));

    		$widget->content = $post_all['content'];
    		
    		$widget->save();
    	}
    	return Redirect::to('widget');
    }

    public function delete($id)
    {
        $id = Helpers::EncodeDecode($id,false);
        $widget = Widget::find($id);
        if(count($widget))
        {
           $widget->delete();
        }
        return Redirect::to('widget');
    }
}