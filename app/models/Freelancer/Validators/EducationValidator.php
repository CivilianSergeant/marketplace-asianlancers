<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/3/14
 * Time: 5:32 PM
 */

class EducationValidator {

    private static $rules = array(
        'institute_name'    => 'required',
        'area_of_study'     => 'required',
        'start_year'        => 'required',
        'end_year'          => 'required',

    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);

        $errorMsg = $validator->messages()->getMessages();

        return $errorMsg;

    }
} 