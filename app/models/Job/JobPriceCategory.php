<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:43 PM
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobPriceCategory extends Eloquent{

    use SoftDeletingTrait;
    /**
     * Table Name
     * @var string
     */
    protected $table="job_prices";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('title','display');

    public static function Persist($data)
    {
        $jobPriceCategory = self::firstOrNew(array(
                                    'title'=>$data['title']
                                ));

        if(!$jobPriceCategory->exists)
        {
            $jobPriceCategory->display = 1;
            $jobPriceCategory->save();
        }else{
            $jobPriceCategory->save();
        }

        return $jobPriceCategory;
    }
}