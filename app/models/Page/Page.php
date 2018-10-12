<?php

class Page extends Eloquent
{
	 /**
     * Table name
     * @var string
     */
    protected $table = "pages";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('title','description','page_type','excerpt','url');

    public static $MAIN = 'MAIN';
    public static $CLIENT = 'CLIENT';
    public static $FREELANCER = 'FREELANCER';

    public static $PAGE_TYPES = array('MAIN','CLIENT','FREELANCER');
}