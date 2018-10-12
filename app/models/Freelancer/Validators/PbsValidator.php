<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/7/14
 * Time: 11:58 AM
 */

class PbsValidator {

    private static $rules = array(
        'org_name'       => 'required',
        'org_type'       => 'required',
        'responsibility' => 'required',
        'address'        => 'required'
    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);

        $errorMsg = $validator->messages()->getMessages();

        return $errorMsg;

    }
} 