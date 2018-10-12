<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 8/14/14
 * Time: 4:54 PM
 */

class NotFoundController extends BaseController{

    public function index()
    {
        return Theme::make('error.index',array());
    }
} 