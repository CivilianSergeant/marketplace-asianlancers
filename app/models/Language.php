<?php
/**
 * Created by PhpStorm.
 * User: HimelC51
 * Date: 10/15/14
 * Time: 4:53 PM
 */

class Language {


    protected static $language = 'cdn/language/language.xls';

    public static function getData()
    {
        $data = new SpreadsheetExcelReader(self::$language);
        $currentSheet = array_shift($data->sheets);
        $cells = $currentSheet['cells'];
        $db = array();
        if(count($cells))
        {
            foreach($cells as $cell)
            {
                if(!empty($cell[1]) && !empty($cell[2]))
                    $db[$cell[1]]=$cell[2];
            }
        }
        return $db;
    }
} 