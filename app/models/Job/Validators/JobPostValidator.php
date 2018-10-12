<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/20/14
 * Time: 1:51 PM
 */


class JobPostValidator {
    private static  $rules = array(
        'job_category_id' => 'required|integer',
        'title' => 'required',
        'description' => 'required',
        'hour' => 'required|min:1|numeric',
        'skill_tags_id' => 'required|array',
        'freelancer_price' => 'required|array',
    );
	private static  $rules_only_file = array(
        'file' => 'mimes:png,gif,jpeg,txt,pdf,doc,rtf,zip|max:20000'
    );
	
	private static  $edit_rules = array(
        'title' => 'required',
        'description' => 'required',
        'hour' => 'required|min:1|numeric',
    );

    private static  $admin_rules = array(
        'job_category_id' => 'required|integer',
        'client_id'=> 'required',
        'title' => 'required',
        'description' => 'required',
        'hour' => 'required|min:1|numeric',
        'skill_tags_id' => 'required|array',
        'freelancer_price' => 'required|array',
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
	
	public static function validateUpdate($data){
        $validator = Validator::make($data, self::$edit_rules);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }

    public static function validateAdmin($data){
        $validator = Validator::make($data, self::$admin_rules);

        if ($validator->fails())
        {
            return  $validator->messages()->getMessages();
        }else{
            return  $validator->messages()->getMessages();
        }
    }
} 