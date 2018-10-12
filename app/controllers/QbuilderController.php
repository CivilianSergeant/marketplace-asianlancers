<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/24/14
 * Time: 11:08 AM
 */

class QbuilderController extends BaseController{

    protected $defaultRoute = 'qbuilder/lists';
    private $user;
    private $user_id;
    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
        $this->user_id = $this->user;
        View::share('notifications',array());
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
    }

    public function Index()
    {
        return Redirect::to($this->defaultRoute);
    }

    public function Create()
    {
        $viewModel = array();
        $viewModel['levels'] = QuestionLevel::all();
        $viewModel['groups'] = QuestionGroup::all();
        $viewModel['skills'] = SkillTag::all();
        return Theme::make('question.index',$viewModel);
    }

    public function Add()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  QbuilderValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }
            $questionBank = QuestionBank::Persist($post_data);
            if(!empty($questionBank) && !empty($questionBank->id))
            {
                return array('status'=>'200','url'=> url('qbuilder'));
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Question not saved')));
            }
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function Lists()
    {
        $viewModel = array();
        $viewModel['questions'] = QuestionBank::with('SkillTag','QLevel','QGroup')->get();
        return Theme::make('question.lists',$viewModel);
    }

    public function Edit()
    {
        $id = Request::segment(3);
        $questionBank = QuestionBank::find($id);
        if(count($questionBank))
        {
            $viewModel['levels'] = QuestionLevel::all();
            $viewModel['groups'] = QuestionGroup::all();
            $viewModel['skills'] = SkillTag::all();
            $answerData = json_decode($questionBank->answers);
            $answers = array();
            foreach($answerData as $i =>$answer)
            {
                //Helpers::debug(htmlentities($answer['answer'],1);
                $answers[$i]['answer'] = html_entity_decode($answer->answer);
                $answers[$i]['correct'] = $answer->correct;

            }
            $questionBank->question = html_entity_decode($questionBank->question);
            $questionBank->answers = $answers;
            $viewModel['question'] = $questionBank;
            return Theme::make('question.edit',$viewModel);
        }else{
            return Redirect::to('qbuilder/lists');
        }

    }

    public function Update()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  QbuilderValidator::validate($post_data);
            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }

            $questionBank = QuestionBank::Persist($post_data);
            if(!empty($questionBank) && !empty($questionBank->id))
            {
                return array('status'=>'200','url'=> url('qbuilder'));
            }
            else{
                return array('status'=>'400','msg'=>array(array('Sorry Question not saved')));
            }
        }
        else
        {
            return Redirect::to($this->defaultRoute);
        }
    }

    public function DeleteQuestion()
    {
        if(Request::isMethod('post'))
        {
            $id = Input::get('id');
            $questionBank = QuestionBank::find($id);
            if(count($questionBank))
                $questionBank->delete();
            return 1;
        }else{
            return Redirect::to('/');
        }
    }

    public function Qsets()
    {
        $viewModel = array();
        $viewModel['sets'] = QuestionSet::with('SkillTag')->get();
        return Theme::make('question.set.lists',$viewModel);
    }

    public function QsetCreate()
    {
        $viewModel = array();
        $viewModel['skills'] = SkillTag::all();
        $viewModel['groups'] = QuestionGroup::all();
        $viewModel['levels'] = QuestionLevel::all();
        return Theme::make('question.set.create',$viewModel);
    }

    public function AddQset()
    {
        if(Request::isMethod('post'))
        {
             $post_data = Input::all();
             $errorMsg =  QsetValidator::validate($post_data);

             if(count($errorMsg))
             {

                 return array('status'=>'400','msg'=>$errorMsg);
             }

             $questionSet = QuestionSet::Persist($post_data);

             if(count($questionSet) && !empty($questionSet->id))
             {
                 return array('status'=>'200','url'=>url('qbuilder/qsets'));
             }
             else
             {
                 return array('status'=>'400', 'msg'=>array(array('Sorry Question not saved')));
             }
        }else{

            return Redirect::to('/');
        }

    }

    public function QsetEdit()
    {
        $id = Request::segment(3);
        $qset = QuestionSet::find($id);
        if(count($qset))
        {

            $viewModel['skills'] = SkillTag::all();
            $viewModel['groups'] = QuestionGroup::all();
            $viewModel['levels'] = QuestionLevel::all();
            $qset->question_rule = json_decode($qset->question_rule);
            $viewModel['qset'] = $qset;
            return Theme::make('question.set.edit',$viewModel);
        }
        else
        {
            return Redirect::to('qbuilder/qsets');
        }
    }

    public function UpdateQset()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $errorMsg =  QsetValidator::validate($post_data);

            if(count($errorMsg))
            {
                return array('status'=>'400','msg'=>$errorMsg);
            }

            $questionSet = QuestionSet::Persist($post_data);

            if(count($questionSet) && !empty($questionSet->id))
            {
                return array('status'=>'200','url'=>url('qbuilder/qsets'));
            }
            else
            {
                return array('status'=>'400', 'msg'=>array(array('Sorry Question not saved')));
            }
        }
        else
        {
            return Redirect::to('qbuilder/qsets');
        }
    }

    public function DeleteQset()
    {
        if(Request::isMethod('post'))
        {
             $id = Input::get('id');
             $questionSet = QuestionSet::find($id);
             if(count($questionSet))
                $questionSet->delete();
             return 1;
        }else{
            return Redirect::to('/');
        }
    }

    public function Levels()
    {
        $viewModel = array();
        $viewModel['levels'] = QuestionLevel::GetAll();
        return Theme::make('question.levels.index',$viewModel);
    }

    public function AddLevel()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            return QuestionLevel::Persist($post_data);
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function DeleteLevel()
    {
        if(Request::isMethod('post'))
        {
            $id = Input::get('id');
            $questionLevel = QuestionLevel::find($id);
            if(count($questionLevel))
                $questionLevel->delete();
            return 1;
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function Groups()
    {
        $viewModel = array();
        $viewModel['groups'] = QuestionGroup::GetAll();
        return Theme::make('question.groups.index',$viewModel);
    }

    public function AddGroup()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            return QuestionGroup::Persist($post_data);
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function DeleteGroup()
    {
        if(Request::isMethod('post'))
        {
            $id = Input::get('id');
            $questionGroup = QuestionGroup::find($id);
            if(count($questionGroup))
                $questionGroup->delete();
            return 1;
        }
        else
        {
            return Redirect::to('/');
        }
    }


} 