<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/9/14
 * Time: 4:08 PM
 */

class ExamController extends BaseController{

    protected $defaultRoute = '/';
    protected $userAccount;
    protected $id;
    protected static $qset;
    public function __construct()
    {
        parent::__construct();
        $this->userAccount = Sentry::getUser();
        $this->user_id = $this->userAccount->user_id;
        View::share('notifications',array());
        View::share('messageCount',DiscussionComments::UnreadMessageCount($this->user_id));
    }

    public function Index()
    {
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();

            $relatedTag = RelatedTag::where('id',$post_data['id'])->where('relatedentity_id',$this->user_id)
                                    ->where('relatedentity_type','Freelancer')->first();

            if(count($relatedTag))
            {

                $q_set_id = Session::get('qsetid');
                if(!empty($relatedTag->retake_date))
                {
                    Helpers::addMessage(400, ' You could not retake test for this skill before '. date('j F, Y',$relatedTag->retake_date));
                    return Redirect::to('freelancer/skills');
                }
                if(!empty($relatedTag->test_end_at) || !empty($relatedTag->test_result))
                {
                    $ID = Helpers::EncodeDecode($relatedTag->id);
                    return Redirect::to('exam/result/'.$ID);
                }
                if(!empty($q_set_id) && !empty($relatedTag->test_start_at) && empty($relatedTag->test_end_at))
                {
                    return Redirect::to('exam/taking');
                }
                $skill = $relatedTag->GetTag;

                $viewModel['skill'] = $skill;
                $viewModel['rskill'] = $relatedTag;

                $qSet = QuestionSet::where('skill_id',$skill->id)->orderByRaw("RAND()")->first();

                if(count($qSet) == 0)
                {
                    Helpers::addMessage(400,'No Question Set found for this skill or technology, try again later.');
                    return Redirect::to('freelancer/skills');
                }

                //RelatedTag::Update($relatedTag->id,array('last_question_set'=>$qSet->id,'deleted_at'=>null));
                $relatedTag->last_question_set = $qSet->id;
                $relatedTag->deleted_at = null;
                $relatedTag->save();
                //Helpers::debug($relatedTag,1);
                $viewModel['questionSet'] = $qSet;
                Session::put('qsetid',$qSet->id);
                return Theme::make('exam.index',$viewModel);
            }else{
                Helpers::addMessage(400, " With ID ({$post_data['id']})No skill found for take test");
                return Redirect::to('freelancer/overview');
            }

        }else{

            return Redirect::to('freelancer/skills');
        }
    }

    public function started()
    {
        $q_set_id = Session::get('qsetid');
        if(Request::isMethod('post') && !empty($q_set_id))
        {

            $post_data = Input::all();
            $qSetId = $post_data['tid'];
            $rId = $post_data['rid'];
            $relatedTag = RelatedTag::find($rId);

            $questionSet = QuestionSet::find($q_set_id);
            //Helpers::debug($relatedTag,1);


            $elapseTime = ceil((time() - $relatedTag->test_start_at)/60);
            $Id = Helpers::EncodeDecode($relatedTag->id);
            if($q_set_id != $qSetId)
            {
                return Redirect::to('freelancer/skills');
            }

            if(count($relatedTag)>0 && $relatedTag->skill_tags_id != $questionSet->skill_id)
            {
                return Redirect::to('freelancer/skills');
            }

            if(!empty($q_set_id) && ($relatedTag->test_taken == 1) && !empty($relatedTag->test_start_at)  && empty($relatedTag->test_end_at))
            {
                if($elapseTime < $questionSet->test_time)
                {
                    return Redirect::to('exam/taking');

                }else{
                    return Redirect::to('exam/result/'.$Id);
                }
            }elseif(!empty($q_set_id) && ($relatedTag->test_taken == 1) && !empty($relatedTag->test_start_at)  && !empty($relatedTag->test_end_at))
            {
                return Redirect::to('exam/result/'.$Id);
            }

            if(count($questionSet))
            {

                self::$qset = $questionSet;
                $questions = QuestionCollection::GetCollection($questionSet);

                if(count($questions))
                {
                    $startTime = time();
                    /*RelatedTag::Update($relatedTag->id,array(
                        'test_taken'=>1,
                        'last_question_index' => 0,
                        'test_data' => json_encode($questions),
                        'last_question_set' => $questionSet->id,
                        'deleted_at'    => null
                    ));*/
                    $relatedTag->test_taken = 1;
                    $relatedTag->test_start_at = $startTime;
                    $relatedTag->last_question_index = 0;
                    $relatedTag->test_data = json_encode($questions);
                    $relatedTag->last_question_set = $questionSet->id;
                    $relatedTag->deleted_at = null;
                    $relatedTag->save();
                    return Redirect::to('exam/taking');
                }
            }else{
                return Redirect::to('freelancer/skills');
            }


        }else{

            return Redirect::to('freelancer/skills');
        }

    }

    public function taking()
    {
        $viewModel = array();
        $q_set_id = Session::get('qsetid');

        if(!empty($q_set_id))
        {
            $questionSet = QuestionSet::find($q_set_id);
            $relatedTag = RelatedTag::where('relatedentity_id',$this->user_id)
                        ->where('relatedentity_type','Freelancer')
                        ->where('skill_tags_id',$questionSet->skill_id)->first();

            $elapseTime = round((time()-$relatedTag->test_start_at)/60);
            $examTotalTime = $questionSet->test_time;
            $Id = Helpers::EncodeDecode($relatedTag->id);

            if($relatedTag->test_taken == 0)
                return Redirect::to('freelancer/skills');

            if(($relatedTag->test_taken == 1) && ($elapseTime > $questionSet->test_time))
            {
                Helpers::addMessage(500, ' Your time over');
                return Redirect::to('exam/result/'.$Id);
            }

            if(($relatedTag->test_taken == 1) && (!empty($relatedTag->test_start_at))  && ($relatedTag->test_end_at == null))
            {
                 $totalQuestion = QuestionCollection::countQuestins($relatedTag);
                 //Helpers::debug($relatedTag->last_question_index,1);
                 if($relatedTag->last_question_index < $totalQuestion)
                 {
                     //Helpers::debug($totalQuestion,1);
                     $question = QuestionCollection::SelectQuestion($relatedTag,$relatedTag->last_question_index);

                     $viewModel['question'] = $question;
                     $viewModel['rskill'] = $relatedTag;

                 }elseif($relatedTag->last_question_index >= $totalQuestion){

                     $oneDay = (60*60*24);
                     $nextExam = 30;
                     $endTime = time();
                     /*RelatedTag::Update($relatedTag->id,array(
                         'test_end_at' => $endTime,
                         'retake_date' => $endTime + ($oneDay*$nextExam),
                         'deleted_at' => null
                     ));*/
                     $relatedTag->test_end_at = time();
                     $relatedTag->retake_date = $relatedTag->test_end_at + ($oneDay*$nextExam);
                     $relatedTag->deleted_at = null;
                     $relatedTag->save();
                     Session::forget('qsetid');
                     return Redirect::to('exam/result/'.$Id);
                 }

            }else{

                 return Redirect::to('exam/result/'.$Id);
            }
            $viewModel['elapse_time'] = $elapseTime;
            $viewModel['total_time'] = $examTotalTime;

        }else{
            return Redirect::to('freelancer/skills');
        }

        return Theme::make('exam.test',$viewModel);
    }

    public function saveAnswer()
    {
        $q_set_id = Session::get('qsetid');

        if(!empty($q_set_id) && Request::isMethod('post'))
        {
            $questionSet = QuestionSet::find($q_set_id);
            $relatedTag = RelatedTag::where('relatedentity_id',$this->user_id)
                ->where('relatedentity_type','Freelancer')
                ->where('skill_tags_id',$questionSet->skill_id)->first();

            $elapseTime = ceil((time()-$relatedTag->test_start_at)/60);

            $Id = Helpers::EncodeDecode($relatedTag->id);

            if($relatedTag->test_taken == 0)
                return Redirect::to('freelancer/skills');

            if(($relatedTag->test_taken == 1) && ($elapseTime > $questionSet->test_time))
            {
                return Redirect::to('exam/result/'.$Id);
            }

            if(($relatedTag->test_taken == 1) && (!empty($relatedTag->test_start_at)) && ($relatedTag->test_end_at == null))
            {
                $question = QuestionCollection::SelectQuestion($relatedTag,$relatedTag->last_question_index);
                $totalQuestion = QuestionCollection::countQuestins($relatedTag);

                $selected_answer = Input::get('selected_answer');

                /*if($question->question_type == 'Radio')
                {*/
                    $question->selected_answer = (is_array($selected_answer))? json_encode($selected_answer) : $selected_answer;

                    $testResult = (!empty($relatedTag->test_result))? json_decode($relatedTag->test_result) : array();
                    $testResult[$relatedTag->last_question_index] = $question;
                    $relatedTag->test_result = json_encode($testResult);
               /* }*/


                if($relatedTag->last_question_index < $totalQuestion)
                {
                    $lastQuestionIndex = ($relatedTag->last_question_index + 1);
                    $relatedTag->last_question_index = $lastQuestionIndex;
                    $relatedTag->deleted_at = null;
                    $relatedTag->save();
                    return Redirect::to('exam/taking');

                }else if($relatedTag->last_question_index >= $totalQuestion)
                {
                    $oneDay = (60*60*24);
                    $nextExam = 30;
                    $relatedTag->test_end_at = time();
                    $relatedTag->retake_date = $relatedTag->test_end_at + ($oneDay*$nextExam);
                    Session::forget('qsetid');
                    $relatedTag->deleted_at = null;
                    $relatedTag->save();
                    return Redirect::to('exam/result/'.$Id);
                }

            }
        }
        else
        {
             return Redirect::to('freelancer/skills');
        }

    }

    public function result()
    {
        $code = Request::segment(3);
        if(!empty($code))
        {
            $scoreScale = 5;
            $viewModel = array();
            $id = Helpers::EncodeDecode($code,false);
            $relatedTag = RelatedTag::find($id);
            if($relatedTag->test_taken ==1 && !empty($relatedTag->test_end_at))
            {

                $questions = json_decode($relatedTag->test_data);
                $data = json_decode($relatedTag->test_result);

                $groupsAnswered = array();
                $groupOriginal = array();
                foreach($questions as $index => $q)
                {

                    if(!empty($groupOriginal[$q->group_id]))
                        $groupOriginal[$q->group_id] += 1;
                    else
                        $groupOriginal[$q->group_id] = 1;

                    if(!empty($data[$index]))
                    {
                        $d = $data[$index];

                        if($d->question_type == 'Radio')
                        {
                            $selectedAnswer = $d->selected_answer;
                            $answers = json_decode($d->answers);
                            if(!empty($answers) && !empty($answers[$selectedAnswer]))
                            {
                                if($answers[$selectedAnswer]->correct)
                                {

                                    if(!empty($groupsAnswered[$d->group_id]))
                                        $groupsAnswered[$d->group_id] += 1;
                                    else
                                        $groupsAnswered[$d->group_id] = 1;


                                }else{
                                    $groupsAnswered[$d->group_id] = 0;
                                }
                            }

                        }
                        elseif($d->question_type == 'Checkbox')
                        {

                            $selectedAnswers = json_decode($d->selected_answer);
                            $answers = json_decode($d->answers);
                            $countAnser = 0;
                            $originalAnswer=0;
                            foreach($selectedAnswers as $selectedAnswer)
                            {
                                if(!empty($answers) && !empty($answers[$selectedAnswer]))
                                {
                                    if($answers[$selectedAnswer]->correct)
                                    {
                                        $countAnser++;
                                    }

                                }
                            }
                            foreach($answers as $answer)
                            {
                               if($answer->correct)
                               {
                                   $originalAnswer++;
                               }
                            }
                            if($originalAnswer == $countAnser)
                            {
                                if(!empty($groupsAnswered[$d->group_id]))
                                    $groupsAnswered[$d->group_id] += 1;
                                else
                                    $groupsAnswered[$d->group_id] = 1;
                            }else{
                                $groupsAnswered[$d->group_id] = 0;
                            }
                        }else
                        {
                            // for textbox

                            $selectedAnswer = $d->selected_answer;
                            $answers = json_decode($d->answers);
                            $answer = array_shift($answers);

                            if(!empty($answer))
                            {
                                if($selectedAnswer == $answer->answer)
                                {

                                    if(!empty($groupsAnswered[$d->group_id]))
                                        $groupsAnswered[$d->group_id] += 1;
                                    else
                                        $groupsAnswered[$d->group_id] = 1;
                                }else{
                                    $groupsAnswered[$d->group_id] = 0;
                                }
                            }
                        }
                    }

                }

                $questionGroup = array();
                $totalObtainedPercentage = 0;
                foreach($groupOriginal as $qi => $q)
                {
                    $qG = QuestionGroup::find($qi);
                    $obtainedGroupPercentage = (($groupsAnswered[$qi]/$q) * 100);
                    $qG->mark = $obtainedGroupPercentage;
                    $totalObtainedPercentage += $obtainedGroupPercentage;
                    $questionGroup[] = $qG;
                }
                $totalPercentage = (count($groupOriginal) * 100);

                $viewModel['rskill'] = $relatedTag;

                $viewModel['score'] = round(($totalObtainedPercentage * $scoreScale )/ $totalPercentage);
                $viewModel['scoreScale'] = $scoreScale;
                $viewModel['totalPercentage'] = $totalPercentage;
                $viewModel['totalObtainedPercentage'] = round(($totalObtainedPercentage*100)/$totalPercentage);
                $viewModel['groups']  = $questionGroup;

                if(empty($relatedTag->test_percentage) && empty($relatedTag->score))
                {
                    $relatedTag->test_percentage = $viewModel['totalObtainedPercentage'];
                    $relatedTag->score = $viewModel['score'];
                    $relatedTag->deleted_at = null;
                    $relatedTag->save();
                }
            }

            return Theme::make('exam.result',$viewModel);
        }else{
            return Redirect::to('freelancer/skills');
        }
    }

    public function getResultLink()
    {
        if(Request::isMethod('post'))
        {
            $id = Input::get('id');
            return Helpers::EncodeDecode($id);
        }else{
            return Redirect::to('/');
        }
    }
} 