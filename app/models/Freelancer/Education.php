<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 11:18 AM
 */

class Education extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "educations";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('freelancer_id','institute_name','area_of_study','start_year','end_year','degree','description');


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
            $education = self::firstOrNew(array(
               'area_of_study' => $postData['area_of_study'],
               'freelancer_id' => $postData['freelancer_id']
            ));

            $education->institute_name          = $postData['institute_name'];
            $education->start_year      = $postData['start_year'];
            $education->end_year        = $postData['end_year'];
            $education->degree        = $postData['degree'];
            $education->description   = $postData['description'];
            if(!$education->exists)
            {
                $education->save();
                return array('status'=>200,'obj'=>$education);

            }else{

                $education->save();
                return array('status'=>202,'obj'=>$education);
            }



        }else{

            $education = self::find($postData['id']);

            if(!empty($postData['institute_name']))
                $education->institute_name = $postData['institute_name'];

            if(!empty($postData['area_of_study']))
                $education->area_of_study = $postData['area_of_study'];
            
            if(!empty($postData['start_year']))
                $education->start_year = $postData['start_year'];

            if(!empty($postData['end_year']))
                $education->end_year = $postData['end_year'];

            if(!empty($postData['degree']))
                $education->degree = $postData['degree'];

            if(!empty($postData['description']))
                $education->description = $postData['description'];

            $education->save();
            return array('status'=>202,'obj'=>$education);
        }

    }


} 