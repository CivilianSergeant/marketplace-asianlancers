<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class JobOfferValidator {
    private static  $rules = array(
        'title' => 'required',
        'description' => 'required',
        'job_offer_hour' => 'required|min:1|numeric',
        'job_offer_price' => 'required|min:1|numeric',
//        'freelancer_id' => 'required|unique:job_offers',
//        'client_id' => 'required',
        'job_post_id' => 'required',
    );

    private static  $status_rules = array(
        'job_offer_status' => 'required',
        'job_offer_status_reason' => 'required',
    );

    private static  $new_offer_rules = array(
        'title' => 'required',
        'description' => 'required',
        'job_offer_hour' => 'required|min:1|numeric',
        'job_offer_price' => 'required|min:1|numeric',
        'freelancer_id' => 'required',
        'job_post_id' => 'required',
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

    public static function statusValidate($data){
        $validator = Validator::make($data, self::$status_rules);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }

    public static function newOfferValidate($data){
        $validator = Validator::make($data, self::$new_offer_rules);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }
} 