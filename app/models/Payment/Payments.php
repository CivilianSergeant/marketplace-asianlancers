<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 5:44 PM
 */

class Payments extends Eloquent{
    /**
     * Table name
     * @var string
     */
    protected $table = "payments";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('client_id','freelancer_id','job_offer_id','amount','payment_id','payment_status','release_dt','paid_dt');

    public static function Persist($postData)
    {

        if(empty($postData['id']))
        {

            $paymentObj = self::firstOrNew(array(
                'client_id'=>$postData['client_id'],
                'freelancer_id'=>$postData['freelancer_id'],
                'job_offer_id' => $postData['job_offer_id'],
                'amount' => $postData['amount'],
                'payment_id' => $postData['payment_id'],
                'payment_status' => $postData['payment_status'],

            ));

            if(!$paymentObj->exists)
            {
                $paymentObj->release_dt = $postData['release_dt'];
                $paymentObj->save();
            }else{
                $paymentObj->paid_dt = $postData['paid_dt'];
                $paymentObj->payment_status = 'Pending';
                $paymentObj->save();
            }
            return $paymentObj;

        }else{

            $paymentObj = self::find($postData['id']);

            if(!empty($postData['payment_status']))
                $paymentObj->payment_status = $postData['payment_status'];

            if(!empty($postData['paid_dt']))
                $paymentObj->paid_dt = $postData['paid_dt'];

            $paymentObj->save();

            return $paymentObj;
        }

    }

    public function Client()
    {
        return $this->belongsTo('Client','client_id','id');
    }

    public function JobOffer()
    {
        return $this->belongsTo('JobOffer','job_offer_id','id');
    }

    public function Freelancer()
    {
        return $this->belongsTo('Freelancer','freelancer_id','id');
    }
} 