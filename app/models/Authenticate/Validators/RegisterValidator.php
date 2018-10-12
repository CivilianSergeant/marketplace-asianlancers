<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class RegisterValidator {
    private static  $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
        'email' => 'required|email|unique:users',
        /*'agreement' => 'required',*/
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