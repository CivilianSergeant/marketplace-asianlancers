<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:54 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;
class RelatedTag extends Eloquent{

    use SoftDeletingTrait;



    /**
     * Table Name
     * @var string
     */
    protected $table="related_tags";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('relatedentity_id','relatedentity_type','skill_tags_id','display',
        'test_taken','test_start_at','test_end_at','test_data','last_question_index','test_result','last_question_set',
        'retake_date','test_percentage','score','deleted_at'
    );

    /*public function save(array $options = Array())
    {
        parent::save(array('deleted_at'=>null));
        //$this->deleted_at = '';
        //$this->syncOriginalAttribute('deleted_at');
        //$this->deleted_at = "";
        //Helpers::debug($this,1);

        //Helpers::debug(get_class_methods($this),1);
    }*/

    /*public static function boot(){
        RelatedTag::updating(function($relatedTag)
        {
            Helpers::debug($relatedTag,1);
        });
    }*/

    public function relatedentity()
    {
    	return $this->morphTo();
    }

    public function GetTag()
    {
    	return $this->belongsTo('SkillTag','skill_tags_id','id');
    }

    /*public static function Update($id,$data)
    {
        return RelatedTag::where('id',$id)->update($data);
    }*/

} 