<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/18/14
 * Time: 11:12 AM
 */

class Portfolio extends Eloquent{

    /**
     * Table name
     * @var string
     */
    protected $table = "portfolios";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('category_name','title','freelancer_id','description','image','url');



    public static function Persist($postData)
    {
        if(empty($postData['id']))
        {
            $portfolio = self::firstOrNew(array(
               'freelancer_id' => $postData['freelancer_id'],
               'title'         => $postData['title'],
               'category_name' => $postData['category_name']
            ));
            $portfolio->description = $postData['description'];
            $portfolio->image       = $postData['image'];
            $portfolio->url         = $postData['url'];


            if(!$portfolio->exists)
            {
                $portfolio->save();
                return array('status'=>200, 'obj'=>$portfolio);
            }
            else
            {
                $portfolio->save();
                return array('status'=>202, 'obj'=>$portfolio);
            }


        }else{

            $portfolio = self::find($postData['id']);

            if(!empty($postData['title']))
                $portfolio->title = $postData['title'];

            if(!empty($postData['category_name']))
                $portfolio->category_name = $postData['category_name'];

            if(!empty($postData['description']))
                $portfolio->description = $postData['description'];

            if(!empty($postData['image']))
                $portfolio->image = $postData['image'];

            if(!empty($postData['url']))
                $portfolio->url = $postData['url'];

            $portfolio->save();
            return array('status'=>202, 'obj'=>$portfolio);
        }

    }

    /**
     * Get the owner of this Portfolio
     * @return mixed
     */
    public function GetFreelancer()
    {
        return $this->belongsTo('Freelancer','freelancer_id','id');
    }
} 