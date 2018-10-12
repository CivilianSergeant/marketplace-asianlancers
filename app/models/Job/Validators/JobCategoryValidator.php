<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class JobCategoryValidator {
    private static  $rules = array(
        'title' => 'required'
    );

    public static function validate($data){
        $validator = Validator::make($data, self::$rules);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }
} 