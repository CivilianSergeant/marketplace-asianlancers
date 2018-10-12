<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 11:23 AM
 */

class Certification extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "certifications";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('freelancer_id','title','provider','description','date_earned','submission_code_or_link');


    /**
     * Get the owner of this Portfolio
     * @return mixed
     */
    public function GetFreelancer()
    {
        return $this->belongsTo('Freelancer','freelancer_id','id');
    }


    public static function Persist($postData)
    {
        if(empty($postData['id']))
        {
            $cert = self::firstOrNew(array(
                'freelancer_id' => $postData['freelancer_id'],
                'title'         => $postData['title']
            ));

            $cert->provider    = $postData['provider'];
            $cert->description = $postData['description'];
            $cert->date_earned = $postData['date_earned'];
            $cert->submission_code_or_link = $postData['submission_code_or_link'];
            if(!$cert->exists)
            {
                $cert->save();
                return array('status'=>200,'obj'=>$cert);

            }else{
                $cert->save();
                return array('status'=>202,'obj'=>$cert);
            }

        }
        else
        {
            $cert = self::find($postData['id']);

            if(!empty($postData['title']))
                $cert->title = $postData['title'];

            if(!empty($postData['provider']))
                $cert->provider = $postData['provider'];

            if(!empty($postData['description']))
                $cert->description = $postData['description'];

            if(!empty($postData['date_earned']))
                $cert->date_earned = $postData['date_earned'];

            if(!empty($postData['submission_code_or_link']))
                $cert->submission_code_or_link = $postData['submission_code_or_link'];

            $cert->save();
            return array('status'=>202,'obj'=>$cert);
        }


    }
} 