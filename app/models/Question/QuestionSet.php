<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:51 PM
 */

class QuestionSet extends Eloquent{
    /**
     * Table name
     * @var string
     */
    protected $table = "question_set";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('skill_id','title','question_rule','test_time');

    public static function Persist($postData)
    {
        if(!empty($postData['id']))
        {
            $questionSet = self::find($postData['id']);
            $questionSet->question_rule = json_encode($postData['rules']);
            $questionSet->skill_id = $postData['skill_id'];
            $questionSet->title = $postData['title'];
            $questionSet->test_time = $postData['test_time'];
            $questionSet->save();

            return $questionSet;
        }
        else
        {
            $questionSet = self::firstOrNew(array(
                'skill_id' => $postData['skill_id'],
                'title'    => $postData['title']
            ));
            $questionSet->question_rule = json_encode($postData['rules']);
            $questionSet->test_time = $postData['test_time'];
            $questionSet->save();

            return $questionSet;
        }

    }

    public function QuestionLevel()
    {
        return $this->belongsTo('QuestionLevel','level_id','id');
    }

    public function QuestionGroup()
    {
        return $this->belongsTo('QuestionGroup','group_id','id');
    }


    public function SkillTag()
    {
        return $this->belongsTo('SkillTag','skill_id','id');
    }

} 