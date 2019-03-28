<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parser\UrlParse;


class UrlParseController extends Controller
{
    //
    public static function add(String $link, $task_id){
      $url = new UrlParse;
      $url->url = $link;
      $url->is_parsed = 0;
      $url->task_parses_id = $task_id;
      $url->save();
      return $url;
    }

    public static function get($link_id){
      $url = UrlParse::find($link_id);
      return $url;
    }

    public static function saveResult($result,$link_id){
      $json = $result;
      $url = UrlParse::find($link_id);
      $url->json_result = $json;
      $url->save;
    }
}
