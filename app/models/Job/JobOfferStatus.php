<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:41 PM
 */
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class JobOfferStatus extends Eloquent{

    use SoftDeletingTrait;

    /**
     * Table name
     * @var string
     */
    protected $table = "job_statuses";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('job_offer_id','status_changer_id','status_changer_type','status_name','status_reason');


    public static function Persist($postData)
    {

            $jobStatus = self::firstOrNew(array(
                'job_offer_id' => $postData['job_offer_id'],
                'status_changer_id' => $postData['status_changer_id'],
                'status_changer_type' => $postData['status_changer_type'],
                'status_name' => $postData['status_name'],
                'status_reason' => $postData['status_reason']
            ));

        $jobStatus->save();

        return $jobStatus;
    }
    public function JobOffer()
    {
        return $this->belongsTo('JobOffer','job_offer_id','id');
    }
} 