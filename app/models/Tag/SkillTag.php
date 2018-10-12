<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:54 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;
class SkillTag extends Eloquent{

    use SoftDeletingTrait;
    /**
     * Table Name
     * @var string
     */
    protected $table="skill_tags";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('category_name','display');

    public static function Persist($data)
    {

       $skillTag = self::firstOrNew(array('category_name'=>$data['category_name']));

       if(!$skillTag->exists)
       {
           $skillTag->display = 1;
           $skillTag->save();
       }else{
           $skillTag->save();
       }

       return $skillTag;
    }


    public static function GetByName($name)
    {
        return self::where('category_name',$name)->first();
    }

} 