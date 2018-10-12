<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/18/14
 * Time: 1:25 PM
 */
class Client extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="clients";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('email','first_name', 'last_name',);

    public static function Persist($postData)
    {
        if(empty($postData['id']))
        {
            $client = self::firstOrNew(array(
                'first_name'=>$postData['first_name'],
                'last_name'=>$postData['last_name'],
                'email'=>$postData['email']
            ));
            $client->client_status  = 'Active';

            $client->save();



        }else{

            $client = self::find($postData['id']);

            if(!empty($postData['profile_title']))
                $client->profile_title = $postData['profile_title'];

            if(!empty($postData['first_name']))
                $client->first_name = $postData['first_name'];

            if(!empty($postData['last_name']))
                $client->last_name = $postData['last_name'];

            if(!empty($postData['description']))
                $client->description = $postData['description'];

            if(!empty($postData['address']))
                $client->address = $postData['address'];

            if(!empty($postData['address2']))
                $client->address2 = $postData['address2'];

            if(!empty($postData['country']))
                $client->country = $postData['country'];

            if(!empty($postData['postal_code']))
                $client->postal_code = $postData['postal_code'];

            if(!empty($postData['city']))
                $client->city = $postData['city'];

            if(!empty($postData['province']))
                $client->province = $postData['province'];

            if(!empty($postData['contact_number']))
                $client->contact_number = $postData['contact_number'];

            if(isset($postData['picture_widget']) && ($postData['picture_widget']===1 || $postData['picture_widget']===0))
                $client->picture_widget = $postData['picture_widget'];

            if(isset($postData['address_widget']) && ($postData['address_widget']===1 || $postData['address_widget']===0))
                $client->address_widget = $postData['address_widget'];

            if(isset($postData['country_widget']) && ($postData['country_widget']===1 || $postData['country_widget']===0))
                $client->country_widget = $postData['country_widget'];

            if(isset($postData['phone_widget']) && ($postData['phone_widget']===1 || $postData['phone_widget']===0))
                $client->phone_widget = $postData['phone_widget'];

            $client->save();

        }
        return $client;
    }

    public static function UpdateAttachFile($data,$fileName){
        $client = self::find($data);
        if(!empty($client)){
            //$fileNames = json_decode($client->attach_file,true);
            //$tmpNames = array_merge($fileNames,$fileName);
            $client->photos = $fileName;//json_encode(array_merge($fileNames,$fileName),JSON_FORCE_OBJECT);
            $client->save();
        }
        return $client->photos;
    }

    /**
     * polymorphic relation it will fetch all notification for admin only
     * @return mixed
     */
    public function UnreadNotifications()
    {
        return $this->morphMany('Notification','receiver')->where('read_status',0)->orderBy('id','DESC');
    }

    public function Notifications()
    {
        return $this->morphMany('Notification','receiver');
    }


    public function Comments()
    {
        return $this->morphMany('Comment','honour')->where('honour_type','Client');
    }


    /**
     * polymorphic relation to user object
     * @return mixed
     */
    public function User()
    {
        return $this->morphMany('User','user');
    }

    public function getName()
    {
        
        return $this->first_name . ' '.$this->last_name;
    }

    public function JobPost()
    {
        return $this->hasMany('JobPost','client_id','id');
    }
	
	public function JobOffer()
    {
        return $this->hasMany('JobOffer','client_id','id');
    }

    public function Payments($limilt=20)
    {
        return $this->hasMany('Payments','client_id','id')->where(function($query){
            $query->where('payment_status','=','Pending')->where('payment_status','=','Paid','OR');
        })->orderBy('id','DESC')->paginate($limilt);
    }

    public static function CompleteJob($id){
        return DB::table('job_posts')->where(array('client_id'=>$id,'job_status'=>'Completed'))->count();
    }

    public static function TotalAmountSpent($clientId)
    {
        return Payments::where('client_id',$clientId)->where('payment_status','Paid')->sum('amount');
    }
    public static function TotalAmountAllJob($id){
        return DB::table('job_offers')->where(array('client_id'=> $id,'job_offer_status'=>'Completed'))->sum('job_offer_price');
    }

    public static function ProgressJob($id){
        return DB::table('job_posts')->where(array('client_id'=>$id,'job_status'=>'Progress'))->count();
    }


}