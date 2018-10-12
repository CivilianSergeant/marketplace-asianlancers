<?php
class Widget extends Eloquent
{
	 /**
     * Table name
     * @var string
     */
    protected $table = "widget";

    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('widget_name','type','location','content');

    public static $TEXT = 'Text';

    public static $LOCATIONS = array('SIDEBAR','FOOTER');
    public static $TYPES = array('Text');

    public static function get($name,$location='')
    {
        $q = self::where('widget_name',$name);
        if(!empty($location))
            $q->where('location',$location);
        $widget = $q->first();
        return $widget->content;
    }
}