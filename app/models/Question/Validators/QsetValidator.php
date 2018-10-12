<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/26/14
 * Time: 2:35 PM
 */

class QsetValidator {

    private static $rules = array(
        'title'       => 'required',
        'test_time'   => 'required',
        'skill_id'    => 'required',
        'rules'       => 'required',
    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);
        $questionMissing = array();
        $errorMsg = $validator->messages()->getMessages();
        if(!empty($errorMsg))
            return $errorMsg;

        $skillId = $data['skill_id'];
        $skill = SkillTag::find($skillId);

        foreach($data['rules'] as $r=> $rule)
        {
            $groupId = $rule['group_id'];
            foreach($rule['questions'] as $q=> $question)
            {

                $levelId = $question['level_id'];
                $qNo     = $question['q_no'];
                $level = QuestionLevel::find($levelId);
                $group = QuestionGroup::find($groupId);
                $questionExist = QuestionBank::where('level_id',$levelId)
                                       ->where('skill_id',$skill->id)
                                       ->where('group_id',$groupId)->count();

                if($questionExist < $qNo && $questionExist > 0)
                {
                    $questionMissing[] = array("For Group: {$group->title} and Level:{$level->title} you can set no of question max {$questionExist} only");
                }else if($questionExist <= 0)
                {
                    $questionMissing[] = array("For Group: {$group->title} and Level:{$level->title} no question created yet");
                }
            }
        }

        if(!empty($questionMissing))
        {
            return $questionMissing;
        }

    }
} 