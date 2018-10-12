<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/9/14
 * Time: 11:14 AM
 */

class PortfolioValidator {

    private static $rules = array(
        'title'         => 'required',
        'category_name' => 'required',
        'url'           => 'required',
        'image'         => 'required'
    );

    public static function validate($data){

        $validator = Validator::make($data, self::$rules);

        $errorMsg = $validator->messages()->getMessages();

        return $errorMsg;

    }
} 