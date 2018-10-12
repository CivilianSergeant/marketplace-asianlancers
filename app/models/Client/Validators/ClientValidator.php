<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class ClientValidator {
    private static  $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'profile_title' => 'required',
    );

    private static  $rules_only_file = array(
        'file' => 'mimes:png,gif,jpeg,txt,pdf,doc,rtf,zip|max:20000'
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

    public static function validateOnlyFile($data){
        $validator = Validator::make($data, self::$rules_only_file);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }
} 