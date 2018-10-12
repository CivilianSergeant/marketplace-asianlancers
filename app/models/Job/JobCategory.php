<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:43 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobCategory extends Eloquent{

    use SoftDeletingTrait;
    /**
     * Table Name
     * @var string
     */
    protected $table="job_categories";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('title','display');

    public static function Persist($data)
    {
        $jobCategory = self::firstOrNew(array(
                                    'title'=>$data['title']
                                ));
        $jobCategory->description = empty($data['description'])?'':$data['description'];

        if(!$jobCategory->exists){
            $jobCategory->display = 1;
            $jobCategory->save();
        }else{
            $jobCategory->save();
        }

        return $jobCategory;
    }
	/**
     * Get Collection of JobPost objects for this freelancer
     * @return mixed
     */
    public function JobPosts()
    {
        return $this->hasMany('JobPost','job_category_id','id');
    }
}