<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/10/14
 * Time: 11:05 AM
 */

class QuestionCollection {

    private static $collection =[];

    public static function GetCollection($qset)
    {
       $questionRules = json_decode($qset->question_rule);

       foreach($questionRules as $rid=> $qrule)
       {
          $skillId = $qset->skill_id;
          $groupId = $qrule->group_id;
          $levelId = $qrule->questions[0]->level_id;
          $limit = $qrule->questions[0]->q_no;
          $questions = QuestionBank::where('skill_id',$skillId)
                                    ->where('group_id',$groupId)
                                    ->where('level_id',$levelId)
                                    ->orderByRaw("RAND()")->take($limit)->get();

          self::$collection[] = (count($questions) > 0) ? $questions->toArray() : array();
       }

        $questions = array();
        foreach(self::$collection as $collection)
        {
            foreach($collection as $q)
                $questions[] = $q;
        }
        //Helpers::debug($questions,1);
        return $questions;
    }

    public static function SelectQuestion($relatedTag,$index)
    {
        $questions = json_decode($relatedTag->test_data);
        //$questions = array_shift($questions);
        //Helpers::debug($questions,1);
        return (!empty($questions))? $questions[$index] : array();
    }

    public static function countQuestins($relatedTag)
    {
        $questions = json_decode($relatedTag->test_data);

        //$questions = array_shift($questions);
        //Helpers::debug(count($questions));
        return (!empty($questions)) ? count($questions) : 0;
    }

} 