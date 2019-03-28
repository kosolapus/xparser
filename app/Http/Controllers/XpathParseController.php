<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parser\XpathParse;
use App\Parser\UrlParse;

class XpathParseController extends Controller
{
    //
    public static function add(String $xpath_name, String $xpath_value, $work_id){

      $xpath = new XpathParse;
      $xpath->xpath_name = $xpath_name;
      $xpath->xpath_value = $xpath_value;
      $xpath->work_id = $work_id;
      $xpath->save();
      return $xpath;
    }

    public static function get($link_id){
      $links = UrlParse::where("task_parses_id",$link_id)->get();
      return $links;
    }
}
