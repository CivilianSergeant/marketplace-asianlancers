<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:53 PM
 */

class QuestionLevel extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "question_level";

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
        $levels = self::all();
        if(!empty($levels))
        {
            foreach($levels as $i=> $level)
            {
                $levels[$i]->no_question = QuestionBank::where('level_id',$level->id)->count();
            }

        }
        return $levels;
    }
} 