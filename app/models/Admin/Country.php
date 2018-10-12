<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 9/1/14
 * Time: 5:37 PM
 */

class Country extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="country";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('iso','name', 'nicename','iso3','numcode','phonecode');
} 