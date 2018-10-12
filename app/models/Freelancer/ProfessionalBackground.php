<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 11:22 AM
 */

class ProfessionalBackground extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "professional_backgrounds";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('freelancer_id','org_name','org_type','start_dt','end_dt',
        'current_status','responsibility','designation','url','address');

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
            $pb = self::firstOrNew(array(
               'freelancer_id' => $postData['freelancer_id'],
               'org_name'      => $postData['org_name']
            ));

            $pb->org_type       = $postData['org_type'];
            $pb->start_dt       = $postData['start_dt'];
            $pb->end_dt         = $postData['end_dt'];
            $pb->current_status = $postData['current_status'];
            $pb->responsibility = $postData['responsibility'];
            $pb->designation    = $postData['designation'];
            $pb->url            = $postData['url'];
            $pb->address        = $postData['address'];
            if(!$pb->exists)
            {
                $pb->save();
                return array('status'=>200,'obj'=>$pb);

            }else{

                $pb->save();
                return array('status'=>202,'obj'=>$pb);
            }

        }else{

            $pb = self::find($postData['id']);

            if(!empty($postData['org_name']))
                $pb->org_name = $postData['org_name'];

            if(!empty($postData['org_type']))
                $pb->org_type = $postData['org_type'];

            if(!empty($postData['start_dt']))
                $pb->start_dt = $postData['start_dt'];

            if(!empty($postData['end_dt']))
                $pb->end_dt = $postData['end_dt'];

            if(isset($postData['current_status']))
                $pb->current_status = $postData['current_status'];

            if(!empty($postData['responsibility']))
                $pb->responsibility = $postData['responsibility'];

            if(!empty($postData['designation']))
                $pb->designation = $postData['designation'];

            if(!empty($postData['url']))
                $pb->url = $postData['url'];

            if(!empty($postData['address']))
                $pb->address = $postData['address'];

            $pb->save();
            return array('status'=>202,'obj'=>$pb);
        }


    }
} 