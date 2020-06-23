<?php
namespace App\Libraries;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


use Stevebauman\Location\LocationServiceProvider;
use Stevebauman\Location\Location;
use Stevebauman\Location\Position;

use App\Model\Setting;
use App\Model\Content;
use Illuminate\Support\Facades\DB;


class Helper
{


    public static function convert_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return rtrim($str, '-');
    }



}
