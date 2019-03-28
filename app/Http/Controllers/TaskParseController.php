<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parser\TaskParse;


class TaskParseController extends Controller
{
    //
    public static function add(String $email){
      $task = new TaskParse;
      $task->email = $email;
      $task->save();
      return $task;
    }
}
