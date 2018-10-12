<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/20/14
 * Time: 12:07 AM
 */

class Job{

    private $params;

    public function __construct($params = array())
    {
        $this->params = $params;
    }

    public function search($jobId = null,$categoryId = null)
    {
        /**
         * $this->params is an array started with 0 index that is controller name
         * $controller = $this->params[0];
         * $method     = $this->params[1];
         * $category   = $this->params[2];
         * $searchTxt  = $this->params[3];
         * $price      = $this->params[4];
         */
            $subQuery = "SELECT job_posts.id as job_id,job_posts.hour,job_posts.amount, job_posts.title,CONCAT(users.first_name,' ',users.last_name) as client, users.user_id as client_id,
                            job_categories.id as category_id, related_tags.relatedentity_type as tag_type,
                            job_categories.title as category,  job_posts.description,
                            GROUP_CONCAT(skill_tags.category_name SEPARATOR ', ') as tags, DATEDIFF(NOW(), MIN(job_posts.created_at)) as days_ago
                         FROM job_posts
                             LEFT JOIN job_categories ON job_posts.job_category_id = job_categories.id
                             LEFT JOIN related_tags ON related_tags.relatedentity_id = job_posts.id
                             LEFT JOIN skill_tags ON related_tags.skill_tags_id = skill_tags.id
                             LEFT JOIN users ON users.user_id = job_posts.client_id
                            WHERE users.user_type = 'Client'
                         GROUP BY job_id ORDER BY job_id DESC";


        $result = DB::table('result')
            ->from(DB::raw("({$subQuery}) as result"));

        if(!empty($this->params[2]) && $this->params[2] != 'nocategory')
            $result = $result->where('category_id', Helpers::EncodeDecode($this->params[2],false));

        if(!empty($this->params[3]) && $this->params[3] != 'nosearchtxt')
            $result = $result->Where('tags','LIKE', '%'.$this->params[3].'%');


        if((!empty($jobId) && !empty($categoryId)) && (is_numeric($jobId) && is_numeric($categoryId)))
        {

            $result = $result->Where('job_id',$jobId);
            $result = $result->Where('category_id',$categoryId);
            $resultSet = $result->first();
            if(count($resultSet))
            {
                $resultSet->description = str_replace("<br>"," ",$resultSet->description);
                $resultSet->excerpt = Str::words(str_replace("<br>"," ",$resultSet->description),50);
                $resultSet->slug = url('view/job/'.Helpers::EncodeDecode($resultSet->category_id).'/'.Helpers::EncodeDecode($resultSet->job_id));
            }
        }else
        {

            $resultSet = $result->get();
            if(!empty($resultSet))
            {
                foreach($resultSet as $i=> $r)
                {
                    $resultSet[$i]->description = str_replace("<br>"," ",$resultSet[$i]->description);
                    $resultSet[$i]->excerpt = Str::words(str_replace("<br>"," ",$resultSet[$i]->description),50);
                    $resultSet[$i]->slug = url('view/job/'.Helpers::EncodeDecode($r->category_id).'/'.Helpers::EncodeDecode($r->job_id));
                }
            }
        }


        return $resultSet;
    }

    public function categories()
    {

        $result = DB::table('job_categories')
                    ->leftJoin('job_posts','job_categories.id','=','job_posts.job_category_id')
                    //->leftJoin('related_tags','related_tags.relatedentity_id','=','job_posts.id')
                    ->groupBy('job_categories.id')
                    ->select(DB::raw("job_categories.title, job_categories.id , count(job_posts.id) as job_count"))
                    //->where('related_tags.relatedentity_type','JobPost')
                    ->get();
        //Helpers::LastQuery();
        if(!empty($result))
        {
            foreach($result as $i=> $r)
            {
                $result[$i]->slug = Helpers::EncodeDecode($r->id);
            }
        }

        return $result;
    }
} 