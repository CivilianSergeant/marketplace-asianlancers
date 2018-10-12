<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class JobPhaseValidator {
    private static  $rules = array(
        'job_offer_id' => 'required',
        'phase_title' => 'required',
        'phase_price' => 'required|min:1|numeric',
        'phase_hour' => 'required|min:1|numeric',
        'phase_start' => 'required|date',
        'phase_deadline' => 'required|date',
        'phase_details' => 'required',
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