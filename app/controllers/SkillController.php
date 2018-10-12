<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/21/14
 * Time: 10:51 AM
 */

class SkillController extends BaseController{

    public function __construct()
    {
        parent::__construct();
        View::share('notifications',array());
        View::share('notifications_count',0);
        View::share('messageCount',0);
    }

    public function Index()
    {
        return Redirect::to('skill/render-skill');
       // $this->RenderSkill();
    }

    public function RenderSkill()
    {
        $viewModel = array();
        $viewModel['skills'] = SkillTag::all();
        return Theme::make('skills.index',$viewModel);
    }

    public function Add()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  SkillTagValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }			
            $skillTag = SkillTag::Persist($post_data);
            if(!empty($skillTag) && !empty($skillTag->id))
            {
                return array(
						'status'=>'200',
						'url'=> url('skill'),
						'msg'=>array(array('Skill Tag has been submited successfully.')),
						'newData' => $skillTag
					);
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Skill Tag has not been saved.')));
            }

        }else{
            return Redirect::to('/');
        }
    }

    public function UpdateDisplay()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $skillTag = SkillTag::find($post_data['id']);
            if(count($skillTag))
            {
                $skillTag->display = $post_data['value'];
                $skillTag->save();
                return array('status'=>'200','url'=> url('skill'),'msg'=>array(array('Display value of Skill Tag has been updated successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Display value of Skill Tag has not been updated.')));
			}
        }
        else{
            return Redirect::to('/');
        }
    }

    public function Delete()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $skillTag = SkillTag::find($post_data['id']);
            if(count($skillTag))
            {
                $skillTag->delete();
                return array('status'=>'200','url'=> url('skill'),'msg'=>array(array('Skill Tag has been deleted successfully.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Skill Tag has not been deleted.')));
			}
        }else{
            return Redirect::to('/');
        }
    }

    public function PermanentDelete()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $skillTag = SkillTag::find($post_data['id']);
            if(count($skillTag))
            {
                $skillTag->forceDelete();
                return array('status'=>'200','url'=> url('skill'),'msg'=>array(array('Skill Tag has been deleted permanently.')));
            }else{
				return array('status'=>'400','msg'=>array(array('Sorry! Skill Tag has not been deleted.')));
			}
        }else{
            return Redirect::to('/');
        }
    }


} 