<?php
/**
 * Model: date
 *
 * @package scorpion3
 * @subpackage model
 * @author Liquid Edge Solutions
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 *///--------------------------------------------------------------------------------
class date {
    
    /**
     * output date format: default
     */
    public static $DATE_FORMAT_0 = "Y-m-d H:i:s";
    /**
     * output date format: 24-03-12
     */
    public static $DATE_FORMAT_1 = "d-m-y";
    /**
     * output date format: Saturday 24th March 2012
     */
    public static $DATE_FORMAT_2 = "l\, jS F Y"; 
    /**
     * output date format: 5:45pm on Saturday 24th March 2012
     */
    public static $DATE_FORMAT_3 = "g:ia \o\\n l jS F Y"; 
    /**
     * output date format: 24th March 2012
     */
    public static $DATE_FORMAT_4 = "jS F Y"; 
    /**
     * output date format: 15:12:15
     */
    public static $DATE_FORMAT_5 = "H:i:s"; 
    /**
     * output date format: 15:12
     */
    public static $DATE_FORMAT_6 = "H:i";
    /**
     * output date format: 24/03/12
     */
    public static $DATE_FORMAT_7 = "m/d/Y";
    /**
     * output date format: 24th March 2012, 5:45pm
     */
    public static $DATE_FORMAT_8 = "jS F Y\, g:ia"; 
    /**
     * output date format: 5:45pm - 24th March 2012
     */
    public static $DATE_FORMAT_9 = "g:ia \- jS F Y"; 
    /**
     * output date format: 24th Mar, 5:45pm
     */
    public static $DATE_FORMAT_10 = "jS M Y\, g:ia"; 
    /**
     * output date format: 24th Mar
     */
    public static $DATE_FORMAT_11 = "jS M"; 
    /**
     * output date format: Mar 24th 
     */
    public static $DATE_FORMAT_12 = "M jS \- g:ia"; 
    
 	//--------------------------------------------------------------------------------
 	// functions
	//--------------------------------------------------------------------------------
    public static function is_date($date, $format = "Y-m-d G:i:s"){
        if (DateTime::createFromFormat($format, $date) !== FALSE) {
            return $date;
        }
        return false;
    }
	//--------------------------------------------------------------------------------
    public static function is_valid_date_format($date, $format = "Y-m-d G:i:s"){
            return (bool)  api_date::strtodatetime($date, $format);
    }
    //--------------------------------------------------------------------------------
    /**
     * Takes a nova datetime stamp, and substitutes the year in the timestamp with the new year
     * @param type $date
     * @param type $new_year
     * @return boolean
     */
    public static function get_datetime_range_arr( $start_date, $end_date, $step = '+ 1 hour', $format = NOVA_DATETIME ) {
        $dates = array();
        $current = api_date::strtodatetime($start_date);
        $last = api_date::strtodatetime($end_date);

        while( $current < $last ) {
            $dates[] = api_date::strtodatetime($current, $format);
            $current = api_date::strtodatetime("$current $step");
        }

        return $dates;
    }
    //--------------------------------------------------------------------------------
    public static function get_year_list($start_year = 1970) {
        $end_year = api_date::strtodate("today", "Y");
        $return = false;
        
        foreach(range($start_year, (int)date("Y")) as $year) {
            $return[] = $year;
            if($end_year == $year) { break; }
        }
        rsort($return);
        return $return;
    }
    //--------------------------------------------------------------------------------
    public static function get_diff($date, $compare_date = false, $type = "d") {
        if(!$date) { return false; }
        
        if(!$compare_date){
            $compare_date = api_date::strtodatetime();
        }
        
        $datetime1 = new DateTime($date);
        $datetime2 = new DateTime($compare_date);
        $difference = $datetime1->diff($datetime2);
        return $difference->$type;
    }
    //--------------------------------------------------------------------------------
    public static function get_date($date = "today", $format = false) {
        if(!$format){
            $format = date::$DATE_FORMAT_0;
        }
        $return_date = new DateTime($date);
        return date_format($return_date, $format); // 2011-03-03 00:00:00
    }
    //--------------------------------------------------------------------------------
    
}