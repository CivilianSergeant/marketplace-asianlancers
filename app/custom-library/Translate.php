<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Translate {

    public static function get($text, $lang = "en") {

        //echo $text;
        //echo $lang;

        if ($lang == "en" || $lang=="") {
                    //die("en");
            echo $text;
            
        } else {
            App::setLocale($lang);
                  //  die("test");
            $text = trans('messages.' . $text);
            echo str_replace("messages.","",$text);
        }
    }
    
    public static function getReturn($text, $lang = "en") {

        //echo $text;
        //echo $lang;

        if ($lang == "en" || $lang=="") {
                    //die("en");
            return $text;
            
        } else {
            App::setLocale($lang);
                  //  die("test");
            $text = trans('messages.' . $text);
            return str_replace("messages.","",$text);
        }
    }

}

