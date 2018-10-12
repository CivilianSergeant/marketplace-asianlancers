<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:52 PM
 */

class QuestionBank extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "question_bank";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('question','question_type','level_id','group_id','skill_id','answers','answer_time');

    public static function Persist($postData)
    {
        if(!empty($postData['id']))
        {
            $questionBank = self::find($postData['id']);
            $questionBank->question = htmlentities($postData['question']);
            $questionBank->skill_id = $postData['skill_id'];
            $questionBank->question_type = $postData['question_type'];
            $questionBank->level_id = $postData['level_id'];
            $questionBank->group_id = $postData['group_id'];
            $answers = array();
            foreach($postData['answers'] as $i =>$answer)
            {
                //Helpers::debug(htmlentities($answer['answer'],1);
                $answers[$i]['answer'] = htmlentities($answer['answer']);
                $answers[$i]['correct'] = $answer['correct'];

            }

            $questionBank->answers     = json_encode($answers);
            $questionBank->answer_time = $postData['answer_time'];
            $questionBank->save();

            return $questionBank;
        }
        else
        {

            $questionBank = self::firstOrNew(array(
                'question' => $postData['question'],
                'skill_id' => $postData['skill_id'],
                'question_type' => $postData['question_type']
            ));

            $questionBank->level_id    = $postData['level_id'];
            $questionBank->group_id    = $postData['group_id'];
            $answers = array();
            foreach($postData['answers'] as $i =>$answer)
            {
                //Helpers::debug(htmlentities($answer['answer'],1);
                $answers[$i]['answer'] = htmlentities($answer['answer']);
                $answers[$i]['correct'] = $answer['correct'];

            }
            $questionBank->answers     = json_encode($answers);
            $questionBank->answer_time = '00:'.(($postData['answer_time'] < 10)? '0'.$postData['answer_time'] : $postData['answer_time']).':00';
            $questionBank->save();

            return $questionBank;
        }

    }

    public function SkillTag()
    {
        return $this->belongsTo('SkillTag','skill_id','id');
    }

    public function QLevel()
    {
        return $this->belongsTo('QuestionLevel','level_id','id');
    }

    public function QGroup()
    {
        return $this->belongsTo('QuestionGroup','group_id','id');
    }


} 