<?php

class SearchController extends BaseController {

    protected $defaultRoute = 'search/freelancer';

    public function __construct()
    {
        parent::__construct();
        View::share('notifications',array());
        View::share('notifications_count',0);
        View::share('messageCount',0);
    }

	public function Index()
	{
        return Redirect::to($this->defaultRoute);
	}

    public function Freelancer(){
        $flag = Theme::getSessionData('job_create_flag');
        if( array_search('home',$flag)===false)
            return Redirect::to('/');
        elseif(array_search('price',$flag)===false)
            return Redirect::to('/home/price');

        $viewModels = array();
        $viewModels['job_categories'] = JobCategory::all();
        $viewModels['job_prices'] = JobPriceCategory::all();
        $viewModels['skills'] = SkillTag::all();
        $viewModels['page'] = 'search';

        return Theme::make('search.freelancer',$viewModels);
    }
    public function FreelancersList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());
            
            if(empty($postData['page']) || $postData['page']==1)
                $viewModel['start_index'] = 0;
            else{
                $viewModel['start_index'] = (20*$postData['page'])-20;
            }

            $jobCategory = JobCategory::find($postData['cat_id']);
            $viewModel['jobCategory'] = $jobCategory;

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
/*GROUP_CONCAT(distinct (skill_tags.category_name) SEPARATOR ', ') as tags,*/
/*GROUP_CONCAT(related_tags.score SEPARATOR ', ') AS tags_score,*/
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1";

            if(!empty($postData['freelancer_price'])){
                $fp = array();
               // $freelancerPrices = explode(",", $postData['freelancer_price']);
                if(is_array($postData['freelancer_price'])){
                    foreach($postData['freelancer_price'] as $fprice){
                        $fp[] = $fprice['id'];
                    }
                    
                    $fprices = implode(",", $fp);
                }else{
                    $fprices = $postData['freelancer_price'];
                }
                    $subQuery .= " AND freelancer_price IN (SELECT title FROM job_prices WHERE id IN(".$fprices."))";
            }
            if(!empty($postData['skill_tags_id'])){
                $sk = array();
                foreach($postData['skill_tags_id'] as $skill)
                {
                    $sk[] = $skill['id'];
                }
                $skls = implode(",",$sk);
                $subQuery .= " AND skill_tags_id IN (".$skls.")";
            }

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->paginate(20);
                
//            $paginator = Paginator::make($items, $totalItems, $perPage);
//            return array(
//                'status'=>'200',
//                'totalFreelancers'=>count($freelancerList),
//                'url'=> '',
//                'freelancersList'=>$freelancerList//json_encode($freelancerList)
//            );
            $viewModel['freelancerList'] = $freelancerList;
            return Theme::make('search.freelancer-list', $viewModel);
        }else{
            return Redirect::to('/');
        }
    }

    public function NewFreelancersList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
/*GROUP_CONCAT(distinct (skill_tags.category_name) SEPARATOR ', ') as tags,*/
/*GROUP_CONCAT(related_tags.score SEPARATOR ', ') AS tags_score,*/
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1";

            if(!empty($postData['freelancer_price'])){
                $p = implode(',',$postData['freelancer_price']);
                $subQuery .= " AND freelancer_price IN (".$p.")";
            }
            if(!empty($postData['skill_tags_id'])){
                $s = implode(',',$postData['skill_tags_id']);
                $subQuery .= " AND skill_tags_id IN (".$s.")";
            }

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->get();

            return array(
                'status'=>'200',
                'totalFreelancers'=>count($freelancerList),
                'url'=> '',
                'freelancersList'=>$freelancerList//json_encode($freelancerList)
            );

        }else{
            return Redirect::to('/');
        }
    }


    private function getSkillTags($id){
        $skills = DB::table('related_tags');
        $skills->select(array(
            'related_tags.skill_tags_id',
            'skill_tags.category_name',
            'related_tags.test_taken',
            'related_tags.score',
        ));
        $skills->leftJoin('skill_tags', 'related_tags.skill_tags_id', '=', 'skill_tags.id');

        $skills->where('relatedentity_id', '=', $id);
        $skillList=$skills->get();
        return $skillList;
    }

    private function getTotalFeedback($id){
        $item = DB::table('feedbacks');
        $item->where('feedbacks_id', '=', $id);
        $item->where('feedbacks_type', '=', 'Freelancer');
        $total_feedback=$item->sum('feedback_score');
        $total_count=$item->count();

        $t=0;
        if(!empty($total_count) && !empty($total_feedback))
            $t= $total_feedback/$total_count;
        return $t;
    }

    public function portfolioItem($id){
        $item = DB::table('portfolios');
        $item->where('freelancer_id', '=', $id);
        $item=$item->count();
        return $item;
    }

    public function jobs()
    {

        $viewModel = array();
        if(Request::isMethod('post'))
        {
            $post_data = Input::all();
            $queryStr = 'search/jobs';

            $queryStr .= (array_key_exists('category',$post_data) && !empty($post_data['category']))?
                '/'.$post_data['category'] : '/nocategory';
            $queryStr .= (array_key_exists('search_txt',$post_data) && !empty($post_data['search_txt']))?
                '/'.$post_data['search_txt'] : '/nosearchtxt';

            return Redirect::to($queryStr);
        }

        $segments  = Request::segments();

        $jobObj = new Job($segments);
        $viewModel['jobs'] = $jobObj->search();
        $viewModel['categories'] = $jobObj->categories();

        return Theme::make('search.jobs',$viewModel);
    }
    public function JobOfferFreelancerList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());
            $tmpPostData['skill_tags_id'] = $postData['skill_tags_id'];
            $tmpPostData['freelancer_price'] = $postData['freelancer_price'];
            $j = DB::table('job_offers');
            $j->select(array('job_offers.freelancer_id'));
            $j->where('job_post_id',34);
            $jl=$j->get();
//            Helpers::debug($j->toSql());
//            Helpers::debug($jl,1);

            $freelancers = DB::table('freelancers');
            $freelancers->select(array('*','freelancers.id AS fid','freelancers.first_name AS fname','freelancers.last_name AS lname'));
            $freelancers->leftJoin('related_tags', 'freelancers.id', '=', 'related_tags.relatedentity_id');
            $freelancers->leftJoin('users', 'freelancers.id', '=', 'users.user_id');
            $freelancers->leftJoin('job_offers', 'freelancers.id', '=', 'job_offers.freelancer_id');
            $freelancers->where('users.user_type','Freelancer');
//            $freelancers->where('job_offers.job_post_id','!=',$postData['job_id']);
            $freelancers->where('freelancers.available',1);

            $freelancers->where(function ($query) use ($tmpPostData)
            {
                foreach($tmpPostData as $field=>$value)
                {
                    if(!is_array($value))
                        $query->where($field,$value);
                    elseif(is_array($value) && !empty($value)){
                        $query->whereIn($field,$value);
                    }


                }
            });
            $freelancers->groupBy('freelancers.id');
            $freelancerList=$freelancers->get();
//            Helpers::debug($freelancers->toSql(),1);
            //Helpers::LastQuery();
//            Helpers::debug($freelancerList);
            $freelancerTmpList = array();
            $count = 0;
            foreach($freelancerList as $i=>$freelancer){
                $jobRequest = JobRequest::where(array(
                    'request_status'=>'Requested',
                    'job_id'=>$postData['job_id'],
                    'freelancer_id'=>$freelancer->fid
                ))->whereIn('request_status',array('Requested','Accepted','Approved'))->get();
                $jobOffer = JobOffer::where(array(
                    'job_post_id'=>$postData['job_id'],
                    'freelancer_id'=>$freelancer->fid
                ))->whereIn('job_offer_status',array('Pending','Approved','Accepted','Paused','Progress'))->get();
//                'Pending','Approved','Canceled','Accepted','Paused','Completed',,'Declined'
//                Helpers::debug($jobRequest);
//                Helpers::debug(count($jobRequest));
                if(count($jobRequest)==0 && count($jobOffer)==0){
                    $freelancerTmpList[$count] = $freelancer;
                    $freelancerTmpList[$count]->skills=$this->getSkillTags($freelancer->fid);
                    $freelancerTmpList[$count]->portfolio_item=$this->portfolioItem($freelancer->fid);
                    $freelancerTmpList[$count]->code=Helpers::EncodeDecode($freelancer->fid);
                    $freelancerList[$count]->total_feedback=$this->getTotalFeedback($freelancer->fid);
                    $count++;
                }
            }

            return array(
                'status'=>'200',
                'totalFreelancers'=>count($freelancerTmpList),
                'url'=> '',
                'freelancersList'=>$freelancerTmpList//json_encode($freelancerList)
            );

        }else{
            return Redirect::to('/');
        }
    }

    public function JobOfferFreelancersList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());
//            Helpers::debug($postData,1);
            if(empty($postData['page']) || $postData['page']==1)
                $viewModel['start_index'] = 0;
            else{
                $viewModel['start_index'] = (20*$postData['page'])-20;
            }

            $jobPost = JobPost::find($postData['job_id']);

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
/*GROUP_CONCAT(distinct (skill_tags.category_name) SEPARATOR ', ') as tags,*/
/*GROUP_CONCAT(related_tags.score SEPARATOR ', ') AS tags_score,*/
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1";

            if(!empty($postData['freelancer_price'])){
                $p = implode(',',$postData['freelancer_price']);
                if(strlen(trim($p)) > 0)
                {
                    if(preg_match('/^,[0-9]*/', $p))
                        $p = substr($p, 1,strlen($p));
                    if(strlen(trim($p)))
                        $subQuery .= " AND freelancer_price IN (".$p.")";
                }
                    
            }

            if(!empty($postData['skill_tags_id'])){
                $s = implode(',',$postData['skill_tags_id']);
                if(strlen(trim($s)) > 0)
                {
                    if(preg_match('/^,[0-9]*/', $s))
                        $s = substr($s, 1,strlen($s));
                    if(strlen(trim($s)))
                        $subQuery .= " AND skill_tags_id IN (".$s.")";
                }
            }

            $subQuery .= " AND freelancers.id NOT IN (SELECT job_requests.freelancer_id FROM job_requests WHERE job_requests.job_id = {$jobPost->id} AND
			job_requests.request_status IN('Requested','Accepted','Approved'))
AND freelancers.id NOT IN (SELECT job_offers.freelancer_id FROM job_offers WHERE job_offers.job_post_id = {$jobPost->id} AND
		job_offers.job_offer_status IN('Pending','Approved','Accepted','Paused','Progress')
		)";

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->paginate(20);
           
            $viewModel['freelancerList'] = $freelancerList;
            return Theme::make('search.job-offer-freelancer-list', $viewModel);
        }else{
            return Redirect::to('/');
        }
    }

    public function NewJobOfferFreelancerList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());

            $jobPost = JobPost::find($postData['job_id']);

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
/*GROUP_CONCAT(distinct (skill_tags.category_name) SEPARATOR ', ') as tags,*/
/*GROUP_CONCAT(related_tags.score SEPARATOR ', ') AS tags_score,*/
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1";

            if(!empty($postData['freelancer_price'])){
                $p = implode(',',$postData['freelancer_price']);
                if(strlen(trim($p)) > 0)
                {
                    if(preg_match('/^,[0-9]*/', $p))
                        $p = substr($p, 1,strlen($p));
                    if(strlen(trim($p)))
                        $subQuery .= " AND freelancer_price IN (".$p.")";
                }    
                
                
                    
            }

            if(!empty($postData['skill_tags_id'])){
                $s = implode(',',$postData['skill_tags_id']);
                if(strlen(trim($s)) > 0)
                {
                    if(preg_match('/^,[0-9]*/', $s))
                        $s = substr($s, 1,strlen($s));
                    if(strlen(trim($s)))
                        $subQuery .= " AND skill_tags_id IN (".$s.")";
                }

            }

            $subQuery .= " AND freelancers.id NOT IN (SELECT job_requests.freelancer_id FROM job_requests WHERE job_requests.job_id = {$jobPost->id} AND
			job_requests.request_status IN('Requested','Accepted','Approved'))
AND freelancers.id NOT IN (SELECT job_offers.freelancer_id FROM job_offers WHERE job_offers.job_post_id = {$jobPost->id} AND
		job_offers.job_offer_status IN('Pending','Approved','Accepted','Paused','Progress')
		)";

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->get();

            return array(
                'status'=>'200',
                'totalFreelancers'=>count($freelancerList),
                'url'=> '',
                'freelancersList'=>$freelancerList//json_encode($freelancerList)
            );

        }else{
            return Redirect::to('/');
        }
    }

    public function MemberFreelancersList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());
//            Helpers::debug($postData,1);
            if(empty($postData['page']) || $postData['page']==1)
                $viewModel['start_index'] = 0;
            else{
                $viewModel['start_index'] = (20*$postData['page'])-20;
            }

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1 AND freelancers.freelancer_type='Individual'";

            if(!empty($postData['skill_tags_id'])){
                $s = implode(',',$postData['skill_tags_id']);
                $subQuery .= " AND skill_tags_id IN (".$s.")";
            }

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->paginate(20);

            $viewModel['freelancerList'] = $freelancerList;
            return Theme::make('search.member-freelancer-list', $viewModel);
        }else{
            return Redirect::to('/');
        }
    }

    public function NewMemberFreelancersList(){
        $postData = array();
        if(Request::isMethod('post'))
        {
            $postData = array_merge($postData,Input::all());

            $subQuery = "SELECT freelancers.id AS fid, freelancers.first_name AS fname, freelancers.last_name AS lname,
freelancers.photos, freelancers.freelancer_type, freelancers.available, freelancers.verified,
freelancers.profile_title, freelancers.overview, freelancers.freelancer_price, freelancers.address_country,
freelancers.created_at,users.last_login,
GROUP_CONCAT(DISTINCT CONCAT_WS('=>',skill_tags.category_name,related_tags.score,related_tags.test_taken) SEPARATOR ',') AS tags,



COUNT(portfolios.id) AS c_portfolios,
(SELECT SUM(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_ts,
(SELECT COUNT(feedbacks.feedback_score)
FROM feedbacks
WHERE feedbacks.feedbacks_type = 'Freelancer' AND feedbacks.feedbacks_id = freelancers.id
) AS feedbacks_tc


FROM `freelancers`

LEFT JOIN related_tags ON freelancers.id = related_tags.relatedentity_id
LEFT JOIN users ON freelancers.id = users.user_id
LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
LEFT JOIN portfolios ON freelancers.id =portfolios.freelancer_id


WHERE users.user_type = 'Freelancer' AND freelancers.available = 1  AND freelancers.freelancer_type='Individual'";

            if(!empty($postData['skill_tags_id'])){
                $s = implode(',',$postData['skill_tags_id']);
                $subQuery .= " AND skill_tags_id IN (".$s.")";
            }

            $subQuery .= " GROUP BY freelancers.id";


            $freelancerList = DB::table('result')
                ->from(DB::raw("({$subQuery}) as result"))->get();

            return array(
                'status'=>'200',
                'totalFreelancers'=>count($freelancerList),
                'url'=> '',
                'freelancersList'=>$freelancerList//json_encode($freelancerList)
            );

        }else{
            return Redirect::to('/');
        }
    }

}
