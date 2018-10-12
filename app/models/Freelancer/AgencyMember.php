<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 12:41 PM
 */

class AgencyMember extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="freelancer_agency";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('freelancer_id', 'agency_id','agency_join_dt','agency_leave_dt','status');

    /**
     * Get Agency Profile
     * @return mixed
     */
    public function GetAgencyProfile()
    {
        return $this->belongsTo('Freelancer','agency_id','id');
    }

    /**
     * Get My Profile
     * @return mixed
     */
    public function GetMemberProfile()
    {
        return $this->belongsTo('Freelancer','freelancer_id','id');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function($agencyMember)
        {
            /*if(!empty($agencyMember->freelancer_id) && !empty($agencyMember->agency_id))
            {*/
                $agency = $agencyMember->GetAgencyProfile;
                $msgbody = 'You get an team invitation from agency <b>'.$agency->first_name. ' '.$agency->last_name.'</b>';
                $msgbody .= ' <br/> Visit agency profile link <a target="_blank" href="'.url('view/freelancer/'.Helpers::EncodeDecode($agency->id)).'">'.url('view/freelancer/'.Helpers::EncodeDecode($agency->id)).'</a>';
                $data = array(
                  'sender_id'   => $agencyMember->agency_id,
                  'sender_type' => 'Freelancer',
                  'receiver_id' => $agencyMember->freelancer_id,
                  'subject'     => 'Agency Team invitation',
                  'message'     => $msgbody,
                  'url'         => 'team-invitation',
                  'read_status' => 0,
                  'receiver_type' => 'Freelancer',
                  'notification_type' => 'Team Invitation',
                  'object_id'   => Helpers::EncodeDecode($agencyMember->id)
                );
                Notification::Persist($data);
            /*}*/
        });

        static::updated(function($agencyMember){
            $agency = $agencyMember->GetAgencyProfile;
            $data = array(
                'url'         => 'team-invitation',
                'read_status' => 0,
                'receiver_type' => 'Freelancer',
                'notification_type' => 'Team Invitation',
                'object_id'   => Helpers::EncodeDecode($agencyMember->id)
            );
            if($agencyMember->status == 'Accepted')
            {
                $freelancer = $agencyMember->GetMemberProfile;
                $msgbody = '<strong>'.$freelancer->first_name. ' '. $freelancer->last_name. ' joined to your agency</strong>';
                $data['sender_id']   = $agencyMember->freelancer_id;
                $data['sender_type'] = 'Freelancer';
                $data['receiver_id'] = $agencyMember->agency_id;
                $data['subject']     = 'Member Joined';
                $data['message']     = $msgbody;

            }else if($agencyMember->status == 'Canceled')
            {
                $freelancer = $agencyMember->GetMemberProfile;
                $msgbody = '<strong>'.$freelancer->first_name. ' '. $freelancer->last_name. ' declined to join your agency</strong>';
                $data['sender_id']   = $agencyMember->freelancer_id;
                $data['sender_type'] = 'Freelancer';
                $data['receiver_id'] = $agencyMember->agency_id;
                $data['subject']     = 'Team Invitation Declined';
                $data['message']     = $msgbody;
            }else if($agencyMember->status == 'Inactivated')
            {

                $agency = $agencyMember->GetAgencyProfile;
                $msgbody = '<strong>'.$agency->first_name. ' '. $agency->last_name. ' Inactivated you from their agency</strong>';
                $data['sender_id']   = $agencyMember->agency_id;
                $data['sender_type'] = 'Freelancer';
                $data['receiver_id'] = $agencyMember->freelancer_id;
                $data['subject']     = 'Team Invitation Inactivated';
                $data['message']     = $msgbody;
            }
            /*Helpers::debug($agencyMember,1);
            Helpers::debug($data,1);*/
            Notification::Persist($data);

        });


    }

    public static function Persist($postData)
    {
        date_default_timezone_set('Asia/Dhaka');
        $response = array();
        if(empty($postData['id']))
        {
            $agencyMember = self::firstOrNew(array(
               'freelancer_id' => $postData['freelancer_id'],
               'agency_id'     => $postData['agency_id']
            ));
            if(!$agencyMember->exists)
            {
                $agencyMember->status = 'Requested';
                $agencyMember->save();



                $response['status']=200;
            }else{
                $agencyMember->status = 'Requested';
                $agencyMember->save();
                $response['status']=202;
            }

            $response['obj']=$agencyMember;
            $response['msg']='Information updated';
        }else{

            $agencyMember = self::find($postData['id']);

            if(!empty($postData['status']))
                $agencyMember->status = $postData['status'];

            if($postData['status'] == 'Accepted')
            {    $joinDt = date('Y-m-d');

                $agencyMember->agency_join_dt = $joinDt;
            }
            if($postData['status'] == 'Inactivated' || $postData['status'] == 'Canceled')
            {    $leaveDt = date('Y-m-d');

                $agencyMember->agency_leave_dt = $leaveDt;
            }

            $agencyMember->save();

            $response['status']=202;
            $response['obj']=$agencyMember;
            $response['msg']='Information updated';
        }
        return $response;
    }

} 