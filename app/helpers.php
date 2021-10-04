<?php
use Illuminate\Support\Facades\Schema;

if (! function_exists('youtube_code')) {
    function youtube_code($string)
    {
        preg_match('#(?<=(?:v|i)=)[a-zA-Z0-9-_]+|(?<=(?:v|i)\/)[^&?\n]+|(?<=embed\/)[^"&?\n]+|(?<=‌​(?:v|i)=)[^&?\n]+|(?<=youtu.be\/)[^&?\n]+#', $string, $matches);

        return $matches[0];
    }
}

if(! function_exists('ArabicDate')) {
	function ArabicDate($date = '') {
	    $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
	    $your_date = date('y-m-d', strtotime($date)); // The Current Date
	    $en_month = date("M", strtotime($your_date));
	    foreach ($months as $en => $ar) {
	        if ($en == $en_month) { $ar_month = $ar; }
	    }

	    $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
	    $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
	    $ar_day_format = date('D'); // The Current Day
	    $ar_day = str_replace($find, $replace, $ar_day_format);

	    header('Content-Type: text/html; charset=utf-8');
	    $standard = array("0","1","2","3","4","5","6","7","8","9");
	    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
	    $current_date = date('d', strtotime($date)).' '.$ar_month.' '.date('Y', strtotime($date));
	    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

	    return $arabic_date;
	}
}


if (! function_exists('getTableColumns')) {
    function getTableColumns($table)
    {
        return Schema::getColumnListing($table);
    }
}