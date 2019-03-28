<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;

use App\Http\Controllers\TaskParseController;
use App\Http\Controllers\XpathParseController;

use App\Jobs\ParseLinksFile;

class XParser extends Controller
{
    //
    public function parse(Request $request){

    }

    public function showData(Request $request){

      /*
      $validatedData = $request->validate([
          'email' => 'required|email',
          'xpath' => 'requred'
      ]);
      */
      //Create new task
      $task = TaskParseController::add($request->email);
      //Save file with name like a "work_%task_id%"
      $request->links->storeAs('links',"work_".$task->id);
      //Parse XPath
      foreach($request->xpath as $xpath_item){
        //create new XPath
        $xpath = XpathParseController::add($xpath_item["name"],$xpath_item["value"],$task->id);
      }
      //Add job to file parse
      ParseLinksFile::dispatch("links/work_",$task->id);

      //Delete file with links AFTER parsing
      //DeleteLinksFile::dispatch("links/work_".$task->id);
      dd($request->all());
    }
}
