<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 11:07 AM
 */
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Freelancer extends Eloquent{

    use SoftDeletingTrait;
    /**
     * Table Name
     * @var string
     */
    protected $table="freelancers";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('first_name','last_name', 'agency_name',
                                'freelancer_type','freelancer_price',
                                'publish_status','email',
                                'profile_title','overview','years_of_experience','contact_number','available'
    );

    public static $AGENCY     = "Agency";
    public static $INDIVIDUAL = "Individual";
    /**
     * Get Collection of Portfolio objects for this Freelancer
     * @return mixed
     */
    public function Portfolios()
    {
        return $this->hasMany('Portfolio','freelancer_id','id');
    }


    /**
     * Get Collection of Education objects for this freelancer
     * @return mixed
     */
    public function Educations()
    {
        return $this->hasMany('Education','freelancer_id','id');
    }

    /**
     * Get Collection of Professional backgrounds for this freelancer
     * @return mixed
     */
    public function ProfessionalBackgrounds()
    {
        return $this->hasMany('ProfessionalBackground','freelancer_id','id');
    }

    /**
     * Get Collection of Certification for this freelancer
     * @return mixed
     */
    public function Certifications()
    {
        return $this->hasMany('Certification','freelancer_id','id');
    }

    /**
     * Get My Members when freelancer object type with Agency
     * @return mixed
     */
    public function GetAgencyMembers()
    {
        return $this->hasMany('AgencyMember','agency_id','id');
    }

    public function GetAgencies()
    {
        return AgencyMember::where('freelancer_id',$this->id)->get();
    }


    public function JobOffer()
    {
        return $this->hasMany('JobOffer','freelancer_id','id')->where('job_offer_status','Activated');
    }

    public function JobHistories()
    {
        return $this->hasMany('JobOffer','freelancer_id','id')->where('job_offer_status','Completed');
    }

    public function ActiveJobs()
    {
       return $this->hasMany('JobOffer','freelancer_id','id')->where(function($query){
           $query->where('job_offer_status','=','Accepted')->where('job_offer_status','=','Progress','OR');
        });

    }

    public function GetMyJobInvitation()
    {
        return $this->hasMany('JobOffer','freelancer_id','id')->where('job_offer_status','Approved');
    }

    public function GetMyJobRequest()
    {
        return $this->hasMany('JobRequest','freelancer_id','id')->where('request_status','!=','Accepted');
    }

    /**
     * polymorphic relation it will fetch all notification for admin only
     * @return mixed
     */

    public function Notifications()
    {
        return $this->morphMany('Notification','receiver')->orderBy('id','DESC');
    }


    public function Comments()
    {
        return $this->morphMany('Comment','honour')->where('honour_type','Freelancer');
    }
    public function Feedback()
    {
        return $this->morphMany('Feedback','feedbacks');
    }

    public function RelatedTags()
    {
        return $this->morphMany('RelatedTag','relatedentity')->where('deleted_at',null);
    }
    public function RelatedTagsTestTaken()
    {
        return RelatedTag::withTrashed()->where('relatedentity_id',$this->id)->where('test_taken',1)->get();
    }

    public static function Persist($postData)
    {
        if(empty($postData['id']))
        {
            $freelancer = self::firstOrNew(array(
                'email' => $postData['email']
            ));

            $freelancer->profile_title = $postData['profile_title'];
            $freelancer->first_name = $postData['first_name'];
            $freelancer->last_name  = $postData['last_name'];
            $freelancer->overview = $postData['overview'];
            $freelancer->mobile = $postData['mobile'];
            $freelancer->contact_number = $postData['phone'];
            $freelancer->address = $postData['address'];
            $freelancer->freelancer_type = $postData['freelancer_type'];

            $freelancer->save();



        }else{

            $freelancer = self::find($postData['id']);

            if(!empty($postData['profile_title']))
                $freelancer->profile_title = $postData['profile_title'];

            if(!empty($postData['first_name']))
                $freelancer->first_name = $postData['first_name'];

            if(!empty($postData['last_name']))
                $freelancer->last_name = $postData['last_name'];

            if(!empty($postData['price']))
                $freelancer->freelancer_price = $postData['price'];

            if(!empty($postData['overview']))
                $freelancer->overview = $postData['overview'];

            if(!empty($postData['years_of_experience']))
                $freelancer->years_of_experience = $postData['years_of_experience'];

            if(!empty($postData['freelancer_price']))
                $freelancer->freelancer_price = $postData['freelancer_price'];

            if(!empty($postData['division']))
                $freelancer->division = $postData['division'];

            if(!empty($postData['address']))
                $freelancer->address = $postData['address'];

            if(!empty($postData['country']))
                $freelancer->address_country = $postData['country'];

            if(!empty($postData['zip']))
                $freelancer->address_zip = $postData['zip'];

            if(!empty($postData['city']))
                $freelancer->address_city = $postData['city'];

            if(!empty($postData['contact_number']))
                $freelancer->contact_number = $postData['contact_number'];

            if(!empty($postData['mobile']))
                $freelancer->mobile = $postData['mobile'];

            if(!empty($postData['photos']))
                $freelancer->photos = $postData['photos'];

            if(isset($postData['val']) && isset($postData['field']))
                $freelancer->$postData['field'] = $postData['val'];



            $freelancer->save();

        }
        return $freelancer;
    }


    public function GetMyTags()
    {
        $relatedTags = $this->RelatedTags;

        //Helpers::LastQuery();
        foreach($relatedTags as $i=> $rt)
        {
            $relatedTags[$i]['skill'] = $rt->GetTag;
            $relatedTags[$i]['can_take_test'] = QuestionSet::where('skill_id',$rt->skill_tags_id)->count();
        }
        return $relatedTags;
    }

    public function GetMyTests()
    {
        $relatedTags = $this->RelatedTagsTestTaken();

        foreach($relatedTags as $i=> $rt)
        {
            $relatedTags[$i]['skill'] = $rt->GetTag;
        }
        return $relatedTags;
    }

    public function numOfExamTaken()
    {
        $relatedTags = $this->RelatedTags;
        $examTaken = 0;
        foreach($relatedTags as $rskill)
        {
            if($rskill->test_taken == 1)
            $examTaken += 1;
        }
        return $examTaken;
    }

    public function assignTag(Freelancer $freelancer, SkillTag $skillTag)
    {
        $relatedTag = RelatedTag::withTrashed()->where('relatedentity_id',$freelancer->id)
                            ->where('relatedentity_type', 'Freelancer')
                            ->where('skill_tags_id', $skillTag->id)
                            /*->where('display', 1)
                            ->where('test_taken',0)*/
                            ->first();


        $response = array();

        if(!count($relatedTag))
        {
            $relatedTag = new RelatedTag(array(
                'relatedentity_id'=>$freelancer->id,
                'relatedentity_type'=>'Freelancer',
                'skill_tags_id' => $skillTag->id,
                'display'=>1,'test_taken'=>0
            ));

            $relatedTag->save();
            $relatedTag->can_take_test = QuestionSet::where('skill_id',$relatedTag->skill_tags_id)->count();
            $response['exists']=0;
        }else{

            $relatedTag->can_take_test = QuestionSet::where('skill_id',$relatedTag->skill_tags_id)->count();
            if($relatedTag->deleted_at != null)
            {
                $relatedTag->deleted_at = null;
                $relatedTag->save();

                $response['exists']=2;
            }else{
                $response['exists']=1;
            }


        }

        $response['obj']=$relatedTag;
        return $response;
    }

    public function user()
    {
        return $this->morphMany('User','user');
    }

    public static function GetFreelancerByEmail($email)
    {
        return self::where('email',$email)->first();
    }

    public function GetProfileCompleteStatus($profile,$user)
    {

        $response = array();
        $totalItem = ($user->is_agent == 1)? 6 : 7;

        $edu = (count($profile->Educations) > 0 )? 1 : 0;
        $photo = (!empty($profile->photos))? 1 : 0;
        $skills = (count($profile->RelatedTags) > 0)? 1 : 0;
        $address =  (!empty($profile->address)) ? 1 : 0;
        $contact = (!empty($profile->contact_number))? 1 : 0;
        $portfolio = (count($profile->Portfolios)> 0 )? 1 : 0;
        $members = (count($profile->GetAgencyMembers))? 1 : 0;
        $professional_background = (count($profile->ProfessionalBackgrounds)> 0)? 1:0;

        if(($edu == 0) && ($user->is_agent != 1))
            $response['message'][] = 'Please fill up education information';
        elseif($photo == 0)
            $response['message'][] = 'Please Upload your profile photo.';
        elseif($skills == 0)
            $response['message'][] = 'Please add your expertise skills';
        elseif($address == 0)
            $response['message'][] = 'Please add address';
        elseif($contact == 0)
            $response['message'][] = 'Please add contact number';
        elseif($portfolio == 0)
            $response['message'][] = 'Add Projects to your portfolio.';
        elseif($professional_background == 0 && $user->is_agent != 1)
            $response['message'][] = 'Add professional certificates if any';
        elseif($members == 0 && $user->is_agent == 1)
            $response['message'][] = 'Add individual freelancer to your team';
        else
            $response['message'] = array();
        $totalPoint = 0;
        $totalPoint += $photo + $skills + $address + $contact + $portfolio;

        if($user->is_agent != 1)
            $totalPoint += $edu + $professional_background;

        if($user->is_agent == 1)
            $totalPoint += $members;

        $completedPercentage  = round(($totalPoint * 100)/$totalItem);
        $response['total'] = $completedPercentage;
        return $response;
    }

    public function getName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function AvailableStatus($postData)
    {
        $freelancer = self::find($postData['id']);

        if(!empty($freelancer) && !empty($postData['available'])){
            $freelancer->available = $postData['available'];
            $freelancer->save();
        }
    }

    public function getWidgetData()
    {
        $widgetData = array(
            'total_job_completed'=>0,
            'milestone'=>0,
            'total_hours'=>0,
            'avg_feedback'=>0,
            'total_earning' => 0,
            'total_client'  => 0

        );

       if($this->id)
       {
           $completedJobs = JobOffer::with('JobPhase','Feedback')->where('freelancer_id',$this->id)->where('job_offer_status','Completed')->get();
           $completedJobCount =  $completedJobs->count();

           $activeJobs =   JobOffer::where('freelancer_id',$this->id)->where('job_offer_status','Accepted')->get();
           $hours = 0;
           $total_feedback = 0;
           $milestone = 0;
           $totalEarning = 0;
           $totalClients = array();

           if(count($completedJobs))
            {

                foreach($completedJobs as $completedJob)
                {
                    $hours += ($completedJob->job_offer_hour);

                    $jobPhases = $completedJob->JobPhase;

                    if(!empty($jobPhases))
                    {
                         foreach($jobPhases as $jobPhase)
                         {

                             if($jobPhase->phase_payment_status == "Done")
                             {
                                 $milestone++;
                                 $totalEarning += $jobPhase->phase_price;
                             }
                         }
                    }

                    $feedback = $completedJob->Feedback;

                    if(!empty($feedback))
                        $total_feedback += ($feedback->feedback_score);



                }
                $avg_feedback = ($total_feedback/$completedJobCount);
                $widgetData['total_job_completed'] = $completedJobCount;
                $widgetData['total_hours']         = $hours;
                $widgetData['avg_feedback']        = $avg_feedback;
                $widgetData['milestone']           = $milestone;
                $widgetData['total_earning']       = $totalEarning;
            }

            if(count($activeJobs))
            {

                 foreach($activeJobs as $activeJob)
                 {
                     if(!in_array($activeJob->client_id,$totalClients))
                     {
                         $totalClients[] = $activeJob->client_id;
                     }
                 }
                    $widgetData['total_client']        = count($totalClients);
            }


       }


       return  $widgetData;
    }

    public function Payments($limilt=20)
    {
        return $this->hasMany('Payments','freelancer_id','id')->where(function($query){
            $query->where('payment_status','=','Pending')->where('payment_status','=','Paid','OR');
        })->orderBy('id','DESC')->paginate($limilt);
    }

    public function UnreadNotifications()
    {
        return $this->morphMany('Notification','receiver')->where('read_status',0)->orderBy('id','DESC');
    }
} 