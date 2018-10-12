<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:53 PM
 */

class QuestionGroup extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "question_group";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('title');

    public static function Persist($postData)
    {
        $questionLevel = self::firstOrNew(array('title'=>$postData['title']));
        $questionLevel->save();
        $questionLevel->no_question = 0; // custom attribute not in the table
        return $questionLevel;
    }

    public static function GetAll()
    {
        $groups = self::all();
        if(!empty($groups))
        {
            foreach($groups as $i=> $group)
            {
                $groups[$i]->no_question = QuestionBank::where('group_id',$group->id)->count();
            }

        }
        return $groups;
    }
} 