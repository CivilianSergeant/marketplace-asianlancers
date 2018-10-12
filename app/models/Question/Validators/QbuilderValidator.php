<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/26/14
 * Time: 9:39 AM
 */

class QbuilderValidator {

    private static $rules = array(
        'skill_id'    => 'required',
        'group_id'    => 'required',
        'level_id'    => 'required',
        'question'    => 'required',
        'answer_time' => 'required',
        'question_type' => 'required',
        'answers'      => 'required',

    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);
        $correctAnswerMissing = 1;
        $answerTextMissing = 0;

        foreach($data['answers'] as $answer)
        {
            if($answer['correct'] == 1 || $answer['correct'] == true)
            {
                $correctAnswerMissing = 0;

            }
            if(empty($answer['answer']))
            {
                $answerTextMissing = 1;
            }
        }

        $errorMsg = $validator->messages()->getMessages();
        if(!empty($errorMsg))
            return $errorMsg;
        $errors = array();
        if($correctAnswerMissing)
            $errors[]=array('Select correct answer please');
        if($answerTextMissing)
            $errors[]=array('Please type correct answer');
        if(!empty($errors))
            return $errors;


    }
}