<?php
/**
 * Created by PhpStorm.
 * User: tanvir
 * Date:
 * Time:
 */

class TestData extends Eloquent{

    /**
     * Table Name
     * @var string
     */
    protected $table="test_data";


    /**
     * White list for fields
     * @var array
     */
    protected $fillable = array('first_name', 'last_name','age');

    /**
     * polymorphic relation it will fetch all notification for admin only
     * @return mixed
     */



}