<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/3/14
 * Time: 5:32 PM
 */

class CertValidator {

    private static $rules = array(
        'title'    => 'required',
        'provider'     => 'required',
        'submission_code_or_link' => 'required'
    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);

        $errorMsg = $validator->messages()->getMessages();

        return $errorMsg;

    }
} 